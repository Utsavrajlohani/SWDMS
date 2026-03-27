<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'ip.whitelist' => \App\Http\Middleware\IpWhitelistMiddleware::class,
        ]);
        
        // Apply IP Whitelist and Business Profile check globally to web routes
        $middleware->web(append: [
            \App\Http\Middleware\IpWhitelistMiddleware::class,
            \App\Http\Middleware\CheckBusinessProfile::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
