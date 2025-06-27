<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Inertia\Inertia;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {

        //auth()->logout();//No necesario, ya lo hace LogoutController de Fillament
        $locale = app()->getLocale();
        info("LogoutResponse@toResponde locale $locale");

//        return Inertia::location("/login");
        return redirect("/");
    }
}
