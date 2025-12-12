<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = Product::with(['user','category','brand']);
        // optional filters
        if ($request->filled('seller')) $q->where('user_id', $request->seller);
        if ($request->filled('status')) $q->where('status',$request->status);
        if ($request->filled('is_wholesale')) $q->where('is_wholesale', $request->is_wholesale);
        if ($request->filled('is_approved')) $q->where('is_approved', $request->is_approved);

        $products = $q->latest()->paginate(30);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories','brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'slug'=>'nullable|string|unique:products,slug',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'price'=>'required|numeric',
            'sale_price'=>'nullable|numeric',
            'stock'=>'required|integer',
            'description'=>'nullable|string',
            'image'=>'nullable|image',
            'images.*'=>'nullable|image',
            'colors.*'=>'nullable|string',
            'sizes.*'=>'nullable|string',
            'is_wholesale'=>'nullable|boolean',
            'min_qty'=>'nullable|integer',
            'wholesale_price'=>'nullable|numeric',
            'is_approved'=>'nullable|boolean'
        ]);

        DB::transaction(function() use ($request) {
            $slug = $request->slug ?: Str::slug($request->name).'-'.uniqid();

            $mainImage = null;
            if ($request->hasFile('image')) {
                $mainImage = time().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/products'), $mainImage);
            }

            $product = Product::create([
                'user_id' => $request->user_id ?? auth()->id(),
                'name' => $request->name,
                'slug' => $slug,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $mainImage,
                'condition' => $request->condition ?? 'new',
                'is_wholesale' => $request->has('is_wholesale') ? 1 : 0,
                'min_qty' => $request->min_qty,
                'wholesale_price' => $request->wholesale_price,
                'is_approved' => $request->has('is_approved') ? 1 : 0,
                'status' => $request->status ?? 1,
            ]);

            // gallery images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $gname = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('uploads/products'), $gname);
                    ProductImage::create(['product_id'=>$product->id, 'image'=>$gname]);
                }
            }

            // colors
            if ($request->filled('colors')) {
                foreach ((array)$request->colors as $color) {
                    if (trim($color)==='') continue;
                    ProductColor::create(['product_id'=>$product->id, 'color_name'=>$color]);
                }
            }

            // sizes
            if ($request->filled('sizes')) {
                foreach ((array)$request->sizes as $size) {
                    if (trim($size)==='') continue;
                    ProductSize::create(['product_id'=>$product->id, 'size'=>$size]);
                }
            }

            // variants: optional - create variants manually later via separate ui
        });

        return redirect()->route('products.index')->with('success','Product created.');
    }

    public function show($id)
    {
        $product = Product::with(['images','colors','sizes','variants','brand','category','user'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with(['images','colors','sizes','variants'])->findOrFail($id);
        $categories = Category::where('status',1)->get();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product','categories','brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'=>'required|string',
            'slug'=>'nullable|string|unique:products,slug,'.$product->id,
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'price'=>'required|numeric',
            'sale_price'=>'nullable|numeric',
            'stock'=>'required|integer',
            'description'=>'nullable|string',
            'image'=>'nullable|image',
            'images.*'=>'nullable|image',
            'colors.*'=>'nullable|string',
            'sizes.*'=>'nullable|string',
            'is_wholesale'=>'nullable|boolean',
            'min_qty'=>'nullable|integer',
            'wholesale_price'=>'nullable|numeric',
            'is_approved'=>'nullable|boolean'
        ]);

        DB::transaction(function() use ($request, $product) {
            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
                    @unlink(public_path('uploads/products/'.$product->image));
                }
                $mainImage = time().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/products'), $mainImage);
                $product->image = $mainImage;
            }

            $product->update([
                'name'=>$request->name,
                'slug'=>$request->slug ?: Str::slug($request->name),
                'category_id'=>$request->category_id,
                'brand_id'=>$request->brand_id,
                'price'=>$request->price,
                'sale_price'=>$request->sale_price,
                'stock'=>$request->stock,
                'description'=>$request->description,
                'condition'=>$request->condition ?? $product->condition,
                'is_wholesale'=>$request->has('is_wholesale') ? 1 : 0,
                'min_qty'=>$request->min_qty,
                'wholesale_price'=>$request->wholesale_price,
                'is_approved'=>$request->has('is_approved') ? 1 : 0,
                'status'=>$request->status ?? $product->status,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $gname = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('uploads/products'), $gname);
                    ProductImage::create(['product_id'=>$product->id, 'image'=>$gname]);
                }
            }

            // replace colors if provided as array of names
            if ($request->filled('colors')) {
                // delete existing and recreate (simple approach)
                ProductColor::where('product_id',$product->id)->delete();
                foreach ((array)$request->colors as $color) {
                    if (trim($color)==='') continue;
                    ProductColor::create(['product_id'=>$product->id, 'color_name'=>$color]);
                }
            }

            if ($request->filled('sizes')) {
                ProductSize::where('product_id',$product->id)->delete();
                foreach ((array)$request->sizes as $size) {
                    if (trim($size)==='') continue;
                    ProductSize::create(['product_id'=>$product->id, 'size'=>$size]);
                }
            }
        });

        return redirect()->route('products.index')->with('success','Product updated.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // delete images
        if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
            @unlink(public_path('uploads/products/'.$product->image));
        }
        foreach ($product->images as $img) {
            if ($img->image && file_exists(public_path('uploads/products/'.$img->image))) {
                @unlink(public_path('uploads/products/'.$img->image));
            }
            $img->delete();
        }

        ProductColor::where('product_id',$product->id)->delete();
        ProductSize::where('product_id',$product->id)->delete();
        ProductVariant::where('product_id',$product->id)->delete();

        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted.');
    }

    // Admin approve toggle
    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $product->is_approved = 1;
        $product->save();
        // optionally notify seller
        return redirect()->back()->with('success','Product approved.');
    }

    // optional: toggle approval / reject
    public function toggleApproval($id)
    {
        $product = Product::findOrFail($id);
        $product->is_approved = !$product->is_approved;
        $product->save();
        return redirect()->back()->with('success','Product approval toggled.');
    }
}
