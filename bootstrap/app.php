<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Inertia\Inertia;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
//        $middleware->append(\App\Http\Middleware\HandleLanguage::class);
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->report(function( TransportExceptionInterface $exception ){
            return Inertia::render("Welcome");
        });
        $exceptions->render(function(\Symfony\Component\Mailer\Exception\UnexpectedResponseException $exception ){
            session()->flash("banner","Revisa tu correo, no se ha podido entregar el mensaje");
            session()->flash('bannerStyle', 'danger'); // Agregar estilo si es necesario
            return Inertia::location(url("/"));
        });

    })->create();
