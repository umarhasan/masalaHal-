<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // If not authenticated, redirect to login
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect('admin/dashboard');
        } elseif ($user->hasRole('company')) {
            return redirect('company/dashboard');
        } elseif ($user->hasRole('customer')) {
            return redirect('customer/dashboard');
        }

        return $next($request);
    }
}
