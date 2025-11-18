<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::orderBy('step_number')->get();
        return view('admin.processes.index', compact('processes'));
    }

    public function create()
    {
        return view('admin.processes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['step_number','title','description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('processes','public');
        }

        Process::create($data);

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
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['step_number','title','description']);

        if ($request->hasFile('image')) {
            if ($process->image) {
                Storage::disk('public')->delete($process->image);
            }
            $data['image'] = $request->file('image')->store('processes','public');
        }

        $process->update($data);

        return redirect()->route('processes.index')->with('success','Process step updated successfully.');
    }

    public function destroy(Process $process)
    {
        if ($process->image) {
            Storage::disk('public')->delete($process->image);
        }
        $process->delete();
        return redirect()->route('processes.index')->with('success','Process step deleted successfully.');
    }
}
