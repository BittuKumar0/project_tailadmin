<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. 🛡️ CSRF Protection Bypass
        $middleware->validateCsrfTokens(except: [
            'stripe/webhook', 
            'stripe/webhook/*',
        ]);

        // 2. 🔑 Middleware Alias (Role Permission ke liye)
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();