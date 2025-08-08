<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user exists and has the desired status
        if (Auth()->check() && Auth()->user()->status == 'approved') {
            return $next($request);
        }
        if (Auth()->check() && Auth()->user()->status == 'pending') {
            return redirect()->route("pending.user");
        }
        if (Auth()->check() && Auth()->user()->status == 'blocked') {
            return redirect()->route("blocked.user");
        }

        $notification = array(
            'message' => 'Your account is not active Contact Admin!',
            'alert' => 'success'
        );
        Auth::logout() ;
        return redirect()->route("front.index")->with('notification', $notification);

    }
}
