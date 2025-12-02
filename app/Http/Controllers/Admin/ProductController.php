<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // LIST PRODUCTS
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // CREATE PAGE
    public function create()
    {
        $categories = Category::where('status', 1)->latest()->get();
        return view('admin.products.create', compact('categories'));
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'image'       => 'nullable|image',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imageName,
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $file) {
                $gName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products/gallery'), $gName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $gName
                ]);
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_name' => $color['name'],
                    'color_code' => $color['code'] ?? null
                ]);
            }
        }

        if ($request->sizes) {
            foreach ($request->sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size'       => $size
                ]);
            }
        }

        // ✅ Redirect to product list after creation
        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    // EDIT PAGE
    public function edit($id)
    {
        $product = Product::with(['images', 'colors', 'sizes'])->findOrFail($id);
        $categories = Category::where('status', 1)->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/products/' . $imageName))) {
                unlink(public_path('uploads/products/' . $imageName));
            }
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imageName,
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $file) {
                $gName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products/gallery'), $gName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $gName
                ]);
            }
        }

        // ✅ Redirect to product list after update
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }
    public function show($id)
    {
        $product = Product::with(['category', 'images', 'colors', 'sizes'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }
    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        foreach ($product->images as $img) {
            if (file_exists(public_path('uploads/products/gallery/' . $img->image))) {
                unlink(public_path('uploads/products/gallery/' . $img->image));
            }
            $img->delete();
        }

        ProductColor::where('product_id', $id)->delete();
        ProductSize::where('product_id', $id)->delete();

        $product->delete();

        // ✅ Redirect to product list after deletion
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
