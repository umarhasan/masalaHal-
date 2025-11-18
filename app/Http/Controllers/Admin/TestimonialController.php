<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::all();
        return view('admin.testimonials.index', compact('items'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','designation','content','rating']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials','public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success','Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','designation','content','rating']);

        if ($request->hasFile('image')) {
            if ($testimonial->image) { Storage::disk('public')->delete($testimonial->image); }
            $data['image'] = $request->file('image')->store('testimonials','public');
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success','Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) { Storage::disk('public')->delete($testimonial->image); }
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success','Testimonial deleted successfully.');
    }
}
