<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSales = FlashSale::latest()->get();
        return view('admin.flash_sales.index', compact('flashSales'));
    }

    public function create()
    {
        $products = Product::where('status',1)->where('is_approved',1)->get();
        return view('admin.flash_sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string',
            'starts_at'=>'required|date',
            'ends_at'=>'required|date|after:starts_at',
            'is_active'=>'nullable|boolean',
            'products'=>'nullable|array',
            'products.*'=>'exists:products,id'
        ]);

        DB::transaction(function() use ($request) {
            $sale = FlashSale::create([
                'title'=>$request->title,
                'starts_at'=>$request->starts_at,
                'ends_at'=>$request->ends_at,
                'is_active'=>$request->is_active ?? false,
            ]);

            if ($request->filled('products')) {
                foreach ($request->products as $pid) {
                    $p = Product::find($pid);
                    $sale->products()->attach($p->id, ['flash_price' => $p->sale_price ?? $p->price]);
                }
            }
        });

        return redirect()->route('flash-sales.index')->with('success','Flash sale created.');
    }

    public function edit($id)
    {
        $flashSale = FlashSale::with('products')->findOrFail($id);
        $products = Product::where('status',1)->where('is_approved',1)->get();
        return view('admin.flash_sales.edit', compact('flashSale','products'));
    }

    public function update(Request $request, $id)
    {
        $flashSale = FlashSale::findOrFail($id);

        $request->validate([
            'title'=>'nullable|string',
            'starts_at'=>'required|date',
            'ends_at'=>'required|date|after:starts_at',
            'is_active'=>'nullable|boolean',
            'products'=>'nullable|array',
            'products.*'=>'exists:products,id'
        ]);

        DB::transaction(function() use ($request, $flashSale) {
            $flashSale->update([
                'title'=>$request->title,
                'starts_at'=>$request->starts_at,
                'ends_at'=>$request->ends_at,
                'is_active'=>$request->is_active ?? false,
            ]);

            // sync products (keep pivot flash_price as default product price if not provided)
            $sync = [];
            if ($request->filled('products')) {
                foreach ($request->products as $pid) {
                    $p = Product::find($pid);
                    $sync[$p->id] = ['flash_price' => $p->sale_price ?? $p->price];
                }
            }
            $flashSale->products()->sync($sync);
        });

        return redirect()->route('flash-sales.index')->with('success','Flash sale updated.');
    }

    public function destroy($id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $flashSale->products()->detach();
        $flashSale->delete();
        return redirect()->route('flash-sales.index')->with('success','Flash sale removed.');
    }
}
