<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConditionalInertiaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        info(__CLASS__."@".__METHOD__.": Con ruta ".$request->path());

        // Si la ruta es admin o filament, no aplicar Inertia
      if (!str_ends_with($request->path(), 'logout') )
        if (str_starts_with($request->path(), 'admin') || str_starts_with($request->path(), 'filament')) {
            info("ConditionalInertiaMiddleware@handle No aplico Inertia ruta admin en filement");
            return $next($request);
        }
        info("ConditionalInertiaMiddleware@handle  Aplico Inertia");

        // Ejecutar el middleware real de Inertia
        return app(HandleInertiaRequests::class)->handle($request, $next);
    }
}
