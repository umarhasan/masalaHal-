<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadGenrate;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    //Index 
    public function index(){
        $leads = LeadGenrate::with('users')->get();
        return view('admin.leads.index',compact('leads'));
    }

    // Create Leads Genrate 
    public function create()
    {
        return view('admin.leads.create');
    }

    // Store Leads Genrate 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Add other validation rules as needed
        ]);

        Lead::create($request->all());

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    // Edit Leads Genrate
    public function edit(Lead $lead)
    {
        return view('admin.leads.edit', compact('lead'));
    }

    // Update Leads Genrate 
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Add other validation rules as needed
        ]);

        $lead->update($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }
    
    //Leads Show
    public function Show($id){
        $lead = LeadGenrate::with('users')->where('id',$id)->first();
        return view('admin.leads.show',compact('lead'));
    }

    // Leads Genrate Delete 
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
