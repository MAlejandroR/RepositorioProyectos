<?php

use App\Http\Middleware\RedirectBasedOnRoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Inertia\Inertia;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\HandleLanguage::class);
//        $middleware->web(append: [
//          \App\Http\Middleware\EnsureOtpIsVerified::class,
//        ]);
        $middleware->alias([
            'role.redirect' => RedirectBasedOnRoleMiddleware::class,
            'otp.verified' => \App\Http\Middleware\EnsureOtpIsVerified::class,
            'lang' => App\Http\Middleware\HandleLanguage::class,
            'inertia'=>App\Http\Middleware\HandleInertiaRequests::class
        ]);


        $middleware->web(append: [
            //           \App\Http\Middleware\HandleInertiaRequests::class,
           \App\Http\Middleware\ConditionalInertiaMiddleware::class,
//         RedirectBasedOnRoleMiddleware::class,
           \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
           \App\Http\Middleware\HandleLanguage::class,
//         \App\Http\Middleware\EncryptCookies::class, // ← esta debe estar aquí

        ]);
        $middleware->group('verify', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\ConditionalInertiaMiddleware::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\HandleLanguage::class,
        ]);


        //
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: [
            'locale',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->report(function (TransportExceptionInterface $exception) {
            return Inertia::render("Welcome");
        });
        $exceptions->render(function (\Symfony\Component\Mailer\Exception\UnexpectedResponseException $exception) {
            session()->flash("banner", "Revisa tu correo, no se ha podido entregar el mensaje");
            session()->flash('bannerStyle', 'danger'); // Agregar estilo si es necesario
            return Inertia::location(url("/"));
        });
        $exceptions->render(function (MissingGoogleTokenException $e) {
        });

    })->create();
