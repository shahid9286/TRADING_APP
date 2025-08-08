<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    protected $role;

    public function __construct()
    {
        $this->role = null;
    }

    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!$user || !$user->hasAnyRole($roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
