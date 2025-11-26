<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopupBanner;

class PopupBannerController extends Controller
{
    // LIST
    public function index()
    {
        $banners = PopupBanner::latest()->get();
        return view("admin.popup.index", compact("banners"));
    }

    // CREATE
    public function create()
    {
        return view("admin.popup.create");
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|max:5000"
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path("uploads/popup"), $imageName);

        PopupBanner::create([
            "title" => $request->title,
            "image" => "/uploads/popup/" . $imageName,
            "link"  => $request->link,
            "status" => $request->status ?? 1
        ]);

        return redirect()->route("popup.index")->with("success","Banner Added");
    }

    // EDIT
    public function edit($id)
    {
        $banner = PopupBanner::findOrFail($id);
        return view("admin.popup.edit", compact("banner"));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $banner = PopupBanner::findOrFail($id);

        $data = $request->only("title","link","status");

        if ($request->hasFile("image")) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path("uploads/popup"), $imageName);
            $data["image"] = "/uploads/popup/" . $imageName;
        }

        $banner->update($data);

        return redirect()->route("popup.index")->with("success","Banner Updated");
    }

    // DELETE
    public function destroy($id)
    {
        PopupBanner::findOrFail($id)->delete();
        return back()->with("success","Banner Deleted");
    }

    public function show(){}
}
