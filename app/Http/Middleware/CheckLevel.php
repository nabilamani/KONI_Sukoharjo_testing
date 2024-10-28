<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    public function handle($request, Closure $next, $level)
    {
        if (Auth::check() && Auth::user()->level === $level) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have admin access.');
    }
}
