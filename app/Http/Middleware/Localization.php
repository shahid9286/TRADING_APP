<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    public function handle(Request $request, Closure $next): Response
    {
        // $locale = session('locale', config('app.locale'));
        // Check if a 'locale' is set in the session
        if (Session::has('locale')) {
            // Set the application locale to the session value
            App::setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}