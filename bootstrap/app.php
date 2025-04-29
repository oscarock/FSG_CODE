<?php

use App\Http\Middleware\Acesso;
use App\Http\Middleware\Permiso;
use App\Http\Middleware\SqlInyection;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       

        $middleware->alias([
            'acceso' => Acesso::class,
            'SqlInyection' => SqlInyection::class,
            'permiso' => Permiso::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
