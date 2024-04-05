<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $lang =app()->getLocale();
        session()->put("locale", $lang);
        info("1.-HandleLanguaje (middelware) app()->getLocale=   -$lang-");
        return $next($request);
    }
}
