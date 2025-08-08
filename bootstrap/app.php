<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Localization;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckUserType;
use App\Http\Middleware\CheckBranchAccess;
use App\Http\Middleware\CheckEventBelongsToBranch;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'status' => CheckUserStatus::class,
            "locale" => Localization::class,
            "SetLocale" => SetLocale::class,
            "role" => CheckUserType::class,
        ]);
    }) ->withExceptions(function (Exceptions $exceptions) {})->create();