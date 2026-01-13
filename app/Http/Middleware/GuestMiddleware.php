<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login, redirect ke homepage
        if (auth()->check()) {
            return redirect()->route('homepage');
        }

        return $next($request);
    }
}
