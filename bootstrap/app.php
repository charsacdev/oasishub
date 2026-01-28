<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AssignGuestId;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Middleware\CheckProfileStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // Register route middleware
        $middleware->alias([
            'admin.auth' => AdminAuth::class,
            'guest.id' => AssignGuestId::class,
            'auth.user' => EnsureUserIsAuthenticated::class,
            'profile.active' => CheckProfileStatus::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
