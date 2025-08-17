<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRoleStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if logged in
        if (!$user) {
            return redirect()->route('front.login')->with('error', 'Please login first.');
        }

        // Check role = user
        if (!$user->hasRole('user')) {
            return abort(403, 'You have no right to access this page.');
        }

        // Check status approved
        if ($user->status !== 'approved') {
            return redirect()->route('user.blocked');
        }

        return $next($request);
    }
}
