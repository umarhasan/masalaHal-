<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:brands,name',
            'slug' => 'nullable|string|unique:brands,slug',
            'logo' => 'nullable|image|max:2048'
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        $logoName = null;
        if ($request->hasFile('logo')) {
            $logoName = time().'_'.$request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads/brands'), $logoName);
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $logoName,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand created.');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.show', compact('brand'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:brands,name,'.$brand->id,
            'slug' => 'nullable|string|unique:brands,slug,'.$brand->id,
            'logo' => 'nullable|image|max:2048'
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        if ($request->hasFile('logo')) {
            if ($brand->logo && file_exists(public_path('uploads/brands/'.$brand->logo))) {
                @unlink(public_path('uploads/brands/'.$brand->logo));
            }
            $logoName = time().'_'.$request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads/brands'), $logoName);
            $brand->logo = $logoName;
        }

        $brand->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand updated.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo && file_exists(public_path('uploads/brands/'.$brand->logo))) {
            @unlink(public_path('uploads/brands/'.$brand->logo));
        }

        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted.');
    }
}
