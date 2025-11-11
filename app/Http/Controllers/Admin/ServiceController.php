<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\LeadService;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index(Request $request)
    {
        $leadServiceId = $request->input('lead_service_id');
        $services = Service::when($leadServiceId, function ($query, $leadServiceId) {
            return $query->where('lead_service_id', $leadServiceId);
        })->with('leadService')->paginate(10);

        $leadServices = LeadService::all();
        return view('admin.services.index', compact('services', 'leadServices'));
    }

    // Show the form for creating a new service
    public function create()
    {

        $leadServices = LeadService::all();
        return view('admin.services.create', compact('leadServices'));
    }

    // Store a newly created service in storage
    public function store(Request $request)
    {
        $data = $request->validate([
            'name.*' => 'required',
            'description.*' => 'nullable',
            'price.*' => 'required|numeric',
            'credit.*' => 'nullable|numeric|min:0',
            'lead_service_id.*' => 'required|exists:lead_services,id',
        ]);

        // Loop through the input arrays and create each service
        foreach ($request->name as $index => $name) {
            Service::create([
                'name' => $name,
                'description' => $request->description[$index] ?? null,
                'price' => $request->price[$index],
                'credit' => $request->credit[$index],
                'lead_service_id' => $request->lead_service_id[$index],
            ]);
        }

        return redirect()->route('services.index')->with('success', 'Services created successfully.');
    }

    // Show the form for editing the specified service
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $leadServices = LeadService::all();
        return view('admin.services.edit', compact('service', 'leadServices'));
    }

    // Update the specified service in storage
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'credit.*' => 'nullable|numeric|min:0',
            'lead_service_id' => 'required|exists:lead_services,id'
        ]);

        $service = Service::findOrFail($id);
        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Remove the specified service from storage
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

    // Display bulk update page
    public function bulkUpdatePage(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->route('services.index')->with('error', 'No services selected for bulk update.');
        }

        $services = Service::whereIn('id', $ids)->get();
        $leadServices = LeadService::all();
        return view('admin.services.bulk-update', compact('services', 'leadServices'));
    }

    // Handle bulk update action
    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'services.*.id' => 'required|exists:services,id',
            'services.*.name' => 'required|string|max:255',
            'services.*.description' => 'nullable|string',
            'services.*.price' => 'required|numeric|min:0',
            'services.*.credit' => 'required|numeric|min:0',
            'services.*.lead_service_id' => 'required|exists:lead_services,id',
        ]);

        foreach ($data['services'] as $serviceData) {
            $service = Service::findOrFail($serviceData['id']);
            $service->update($serviceData);
        }

        return redirect()->route('services.index')->with('success', 'Services updated successfully.');
    }

}
