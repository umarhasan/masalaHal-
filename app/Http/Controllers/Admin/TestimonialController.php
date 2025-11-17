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
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','position','message']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials','public');
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
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','position','message']);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) { Storage::disk('public')->delete($testimonial->photo); }
            $data['photo'] = $request->file('photo')->store('testimonials','public');
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success','Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) { Storage::disk('public')->delete($testimonial->photo); }
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success','Testimonial deleted successfully.');
    }
}
