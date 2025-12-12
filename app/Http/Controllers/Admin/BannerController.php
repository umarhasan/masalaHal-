<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('position')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string',
            'image'=>'required|image|max:4096',
            'link'=>'nullable|url',
            'position'=>'nullable|integer',
            'status'=>'nullable|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/banners'), $imageName);
        }

        Banner::create([
            'title'=>$request->title,
            'image'=>$imageName,
            'link'=>$request->link,
            'position'=>$request->position ?? 0,
            'status'=>$request->status ?? 0,
        ]);

        return redirect()->route('banners.index')->with('success','Banner created.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title'=>'nullable|string',
            'image'=>'nullable|image|max:4096',
            'link'=>'nullable|url',
            'position'=>'nullable|integer',
            'status'=>'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && file_exists(public_path('uploads/banners/'.$banner->image))) {
                @unlink(public_path('uploads/banners/'.$banner->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/banners'), $imageName);
            $banner->image = $imageName;
        }

        $banner->update([
            'title'=>$request->title,
            'link'=>$request->link,
            'position'=>$request->position ?? $banner->position,
            'status'=>$request->status ?? $banner->status,
        ]);

        return redirect()->route('banners.index')->with('success','Banner updated.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && file_exists(public_path('uploads/banners/'.$banner->image))) {
            @unlink(public_path('uploads/banners/'.$banner->image));
        }
        $banner->delete();
        return redirect()->route('banners.index')->with('success','Banner deleted.');
    }
}
