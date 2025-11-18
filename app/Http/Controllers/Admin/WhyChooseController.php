<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChoose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyChooseController extends Controller
{
    
    public function index()
    {
        $whyChooses = WhyChoose::all();
        return view('admin.why_chooses.index', compact('whyChooses'));
    }

    public function create()
    {
        return view('admin.why_chooses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/why-choose'), $imageName);
            $data['image'] = 'uploads/why-choose/' . $imageName;
        }

        WhyChoose::create($data);

        return redirect()->route('why-chooses.index')->with('success', 'Entry created successfully.');
    }

    public function edit($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        return view('admin.why_chooses.edit', compact('whyChoose'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $whyChoose = WhyChoose::findOrFail($id);
        $data = $request->all();

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/why-choose'), $imageName);
            $data['image'] = 'uploads/why-choose/' . $imageName;
        }

        $whyChoose->update($data);

        return redirect()->route('why-chooses.index')->with('success', 'Entry updated successfully.');
    }

    public function destroy($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);

        if($whyChoose->image && file_exists(public_path($whyChoose->image))){
            unlink(public_path($whyChoose->image));
        }

        $whyChoose->delete();

        return redirect()->route('why-chooses.index')->with('success', 'Entry deleted successfully.');
    }

    
}
