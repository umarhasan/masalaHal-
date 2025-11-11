<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // Create
    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);

        Package::create($request->all());

        return redirect()->route('package.index')
            ->with('success', 'Package created successfully.');
    }

    // Read
    public function index()
    {
        $packages = Package::latest()->get();
         
        return view('admin.packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    // Update
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);

        $package->update($request->all());

        return redirect()->route('package.index')
            ->with('success', 'Package updated successfully');
    }

    // Delete
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully');
    }
}
