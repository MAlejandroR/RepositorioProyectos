<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function Ramsey\Uuid\v1;

class HandleLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        $locale =$request->cookie('locale')??session()->get('locale')??config('app.locale');


        info("Middleware HandleLanguage locale -$locale-");
        app()->setLocale($locale);
      //  info(session()->all());
        return $next($request);
    }
}
