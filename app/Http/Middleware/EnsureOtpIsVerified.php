<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Si el usuario no ha verificado su correo (por OTP)
        info("EnsureOtpIsVeriefied@handle Middleware");

        if (auth()->check()){
            // TOdo REvisar esto.
            //Si el usuario ya se registró como admin. o student, le envío a su ruta



            dump("EnsureOtpVerified  entro en el 1  if auth->check");
            if (!(auth()->user()->otp_verified)) {
                dump("EnsureOtpVerified  entro en el 2 if auth->user ");
                if (!$request->is('verify-code')) { // 👈 ultima condición Evita el bucle
                    dump("EnsureOtpVerified  entro en el 3 if $request->is('verify-code') ");
                    return redirect()->route('verify.code')->with('message', 'Debes verificar tu correo para continuar.');
                }
            }
    }



return $next($request);
}
}
