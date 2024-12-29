<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Update the user's online status and last seen timestamp
            User::where('id', Auth::user()->id)->update([
                'is_online' => true,
                'last_seen' => now(),
            ]);
        }

        return $next($request);
    }

    /**
     * Perform tasks after the response has been sent to the browser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate(Request $request, Response $response)
    {
        if (Auth::check()) {
            // Mark the user as offline
            User::where('id', Auth::user()->id)->update(['is_online' => false]);
        }
    }
}
