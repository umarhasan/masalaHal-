<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index()
    {
        $items = Process::orderBy('step_order')->get();
        return view('admin.processes.index', compact('items'));
    }

    public function create()
    {
        return view('admin.processes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'step_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_order' => 'nullable|integer',
        ]);

        Process::create($request->only(['step_title','description','step_order']));

        return redirect()->route('processes.index')->with('success','Process step created successfully.');
    }

    public function show(Process $process)
    {
        return view('admin.processes.show', compact('process'));
    }

    public function edit(Process $process)
    {
        return view('admin.processes.edit', compact('process'));
    }

    public function update(Request $request, Process $process)
    {
        $request->validate([
            'step_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_order' => 'nullable|integer',
        ]);

        $process->update($request->only(['step_title','description','step_order']));

        return redirect()->route('processes.index')->with('success','Process step updated successfully.');
    }

    public function destroy(Process $process)
    {
        $process->delete();
        return redirect()->route('processes.index')->with('success','Process step deleted successfully.');
    }
}
