<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('backend.login.view')->with('error', 'Please log in first.');
        }

        if (Auth::user()->role != $role) {
            return abort(403, 'Unauthorized access.')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}
