<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $items = Team::all();
        return view('admin.teams.index', compact('items'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','position','bio']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teams','public');
        }

        Team::create($data);

        return redirect()->route('teams.index')->with('success','Team member created successfully.');
    }

    public function show(Team $team)
    {
        return view('admin.teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name','position','bio']);

        if ($request->hasFile('photo')) {
            if ($team->photo) { Storage::disk('public')->delete($team->photo); }
            $data['photo'] = $request->file('photo')->store('teams','public');
        }

        $team->update($data);

        return redirect()->route('teams.index')->with('success','Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        if ($team->photo) { Storage::disk('public')->delete($team->photo); }
        $team->delete();
        return redirect()->route('teams.index')->with('success','Team member deleted successfully.');
    }
}
