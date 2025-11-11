<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadService;

class LeadServiceController extends Controller
{
    public function index()
    {
        $leadServices = LeadService::all();
        return view('admin.leadServices.index', compact('leadServices'));
    }

    public function create()
    {
        return view('admin.leadServices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/lead_services', 'public');
            $data['image'] = $imagePath;
        }

        LeadService::create($data);

        return redirect()->route('lead-services.index');
    }

    public function show($id)
    {
        $leadService = LeadService::findOrFail($id);
        return view('admin.leadServices.show', compact('leadService'));
    }

    public function edit($id)
    {
        $leadService = LeadService::findOrFail($id);
        return view('admin.leadServices.edit', compact('leadService'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $leadService = LeadService::findOrFail($id);
        $data = $request->all();

        // Handle image upload

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/lead_services', 'public');
            $data['image'] = $imagePath;
        }


        $leadService->update($data);

            return redirect()->route('lead-services.index');
        }

    public function destroy($id)
    {
        $leadService = LeadService::findOrFail($id);
        $leadService->delete();

        return redirect()->route('lead-services.index');
    }
}
