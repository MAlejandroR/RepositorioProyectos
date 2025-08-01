<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class RestrictTeacherOnlyAdminProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() &&
            auth()->user()->hasRole('teacher') &&
            !$request->is('admin/projects*')){
                return Inertia::location(route('teacher.dashboard'));
            }

        return $next($request);
    }
}
