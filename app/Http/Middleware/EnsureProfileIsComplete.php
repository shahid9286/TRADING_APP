<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $profile = $user->profile;

            // Agar profile missing ya required fields empty hain
            if (!$profile || !$profile->first_name || !$profile->last_name) {
                if (!$request->is('profile/*')) {
                    return redirect()->route('user.profile.create')
                        ->with('error', 'Please complete your profile before accessing other pages.');
                }
            }
        }

        return $next($request);
    }
}
