<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\User;

class SellerController extends Controller
{
    // List all sellers
    public function index()
    {
        $sellers = Seller::with('user','products')->latest()->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    // Create seller form
    public function create()
    {
        $users = User::doesntHave('seller')->get();
        return view('admin.sellers.create', compact('users'));
    }

    // Store seller
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id|unique:sellers,user_id',
            'store_name'=>'required|string',
            'slug'=>'nullable|string|unique:sellers,slug',
            'logo'=>'nullable|image',
        ]);

        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = time().'_'.$request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads/sellers'), $logo);
        }

        Seller::create([
            'user_id'=>$request->user_id,
            'store_name'=>$request->store_name,
            'slug'=>$request->slug ?: \Str::slug($request->store_name).'-'.uniqid(),
            'bio'=>$request->bio,
            'logo'=>$logo,
            'is_verified'=>$request->has('is_verified') ? 1 : 0,
        ]);

        return redirect()->route('sellers.index')->with('success','Seller added.');
    }

    // Show seller details
    public function show($id)
    {
        $seller = Seller::with(['user','products'=>function($q){ $q->with('images')->latest(); }])->findOrFail($id);
        return view('admin.sellers.show', compact('seller'));
    }

    // Edit seller form
    public function edit($id)
    {
        $seller = Seller::findOrFail($id);
        return view('admin.sellers.edit', compact('seller'));
    }

    // Update seller
    public function update(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);

        $request->validate([
            'store_name'=>'required|string',
            'slug'=>'nullable|string|unique:sellers,slug,'.$seller->id,
            'logo'=>'nullable|image',
        ]);

        if ($request->hasFile('logo')) {
            if ($seller->logo && file_exists(public_path('uploads/sellers/'.$seller->logo))) {
                @unlink(public_path('uploads/sellers/'.$seller->logo));
            }
            $logo = time().'_'.$request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads/sellers'), $logo);
            $seller->logo = $logo;
        }

        $seller->update([
            'store_name'=>$request->store_name,
            'slug'=>$request->slug ?: \Str::slug($request->store_name),
            'bio'=>$request->bio,
            'is_verified'=>$request->has('is_verified') ? 1 : 0,
        ]);

        return redirect()->route('sellers.index')->with('success','Seller updated.');
    }

    // Toggle verification
    public function toggleVerification($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->is_verified = !$seller->is_verified;
        $seller->save();
        return redirect()->back()->with('success','Seller verification status updated.');
    }

    public function verify($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->is_verified = 1;
        $seller->save();

        return redirect()->back()->with('success', 'Seller verified.');
    }

    public function unverify($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->is_verified = 0;
        $seller->save();

        return redirect()->back()->with('success', 'Seller unverified.');
    }

    // Delete seller
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        // Optionally delete seller products here
        $seller->delete();
        return redirect()->route('sellers.index')->with('success','Seller removed.');
    }
}
