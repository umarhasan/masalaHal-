<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Quote::create([
            'user_id' => Auth::id() ?? null, // agar user login hai
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your quote request has been submitted!');
    }
}
