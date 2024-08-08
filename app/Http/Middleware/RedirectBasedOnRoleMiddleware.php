<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user() ?? null;
        info("Middleware RedirectBasedOnRoleMiddleware");
        info($user);
        $role = $user ? $user->getRoleNames()->first() : ""; // Obtener el primer rol
        $name = $user ? $user->name : "";


        info("Middleware RedirectBasedOnRoleMiddleware nombre -$name- rol -$role-");

        $response = $next($request);

        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $role = Auth::user()->getRoleNames()->first(); // Obtener el primer rol

            // Redirigir basado en el rol
            switch ($role) {
                case 'admin':
                    $path = $request->path();
                    info("Middleware RedirectBasedOnRoleMiddleware admin con path -$path- ");
                    if ($request->path() !== 'admin') {
                        info("Middleware RedirectBasedOnRoleMiddleware admin");
                        return redirect('/admin');
                    }
                    break;
                case 'teacher':
                    if ($request->path() !== 'teacher')
                        return redirect('/teacher');
                    break;
                case 'student':
                    if ($request->path() !== 'student')
                        return redirect('/student');
                    break;
            }
        }

        return $response;
    }
}
