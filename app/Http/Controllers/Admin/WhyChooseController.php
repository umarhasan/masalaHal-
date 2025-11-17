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
        $items = WhyChoose::all();
        return view('admin.why_chooses.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why_chooses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('why_chooses', 'public');
        }

        WhyChoose::create($data);

        return redirect()->route('why_chooses.index')->with('success', 'Item created successfully.');
    }

    public function edit(WhyChoose $why_choose)
    {
        return view('admin.why_chooses.edit', compact('why_choose'));
    }

    public function update(Request $request, WhyChoose $why_choose)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('icon')) {
            if ($why_choose->icon) {
                Storage::disk('public')->delete($why_choose->icon);
            }
            $data['icon'] = $request->file('icon')->store('why_chooses', 'public');
        }

        $why_choose->update($data);

        return redirect()->route('why_chooses.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(WhyChoose $why_choose)
    {
        if ($why_choose->icon) {
            Storage::disk('public')->delete($why_choose->icon);
        }

        $why_choose->delete();
        return redirect()->route('why_chooses.index')->with('success', 'Item deleted successfully.');
    }

    public function show(WhyChoose $why_choose)
    {
        return view('admin.why_chooses.show', compact('why_choose'));
    }
}
