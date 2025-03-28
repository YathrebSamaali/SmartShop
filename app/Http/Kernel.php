<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminMiddleware; // Importez votre middleware
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Les middleware globalement chargés par l'application.
     *
     * @var array
     */
    protected $middleware = [
        // ... autres middleware
    ];

    /**
     * Les middleware de route.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,        // Ajoutez cette ligne
    ];

}
