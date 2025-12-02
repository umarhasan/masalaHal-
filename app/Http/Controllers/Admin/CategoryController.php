<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // -------------------------------------------------------------
    // LIST CATEGORIES
    // -------------------------------------------------------------
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    // -------------------------------------------------------------
    // CREATE PAGE
    // -------------------------------------------------------------
    public function create()
    {
        return view('admin.category.create');
    }

    // -------------------------------------------------------------
    // STORE CATEGORY
    // -------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image',
            'status' => 'nullable|boolean',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imageName,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }

    // -------------------------------------------------------------
    // EDIT PAGE
    // -------------------------------------------------------------
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // -------------------------------------------------------------
    // UPDATE CATEGORY
    // -------------------------------------------------------------
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image',
            'status' => 'nullable|boolean',
        ]);

        // Handle image upload
        $imageName = $category->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/categories/' . $imageName))) {
                unlink(public_path('uploads/categories/' . $imageName));
            }
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imageName,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    // -------------------------------------------------------------
    // DELETE CATEGORY
    // -------------------------------------------------------------
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete image if exists
        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }

    // -------------------------------------------------------------
    // SHOW CATEGORY
    // -------------------------------------------------------------
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }
}
