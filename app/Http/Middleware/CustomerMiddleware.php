<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to access your account.');
        }
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
