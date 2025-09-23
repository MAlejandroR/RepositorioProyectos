<?php

namespace App\Http\Responses;

use App\Services\OtpService;
use Laravel\Fortify\Contracts\LoginResponse;
use Inertia\Inertia;

class CustomLoginResponse implements LoginResponse
{
    public function toResponse($request )
    {


        $user = auth()->user();



//        if (!$user->is_verified) {
//            return redirect('/verify-code');
//        }

        $rol = $user->getRoleNames()->first();
        debugAuthAdmin("CustomLoginResponse@toResponse user: $user->name - role: -$rol-");


        //Si soy admin quier enviar código de verificación
        if ($rol == "admin") {
            app(OtpService::class)->sendOtp($user);
            return Inertia::location("/verify-code");
        }


        return match ($rol) {
            //'admin' => redirect('/admin'),
            'admin' => Inertia::location('/admin'),
            //'admin' => redirect()->away('https://google.com'),
            'student' => redirect('/dashboard/student'),

            'teacher' => Inertia::location('teacher'),
//            'teacher' => Inertia::location("/login-sucess?password_set=" . ($user->password ? 1 : 0)),
//            Esta RUTA ES PARA IR DIRECTAMENTE A FILAMENT
            //'teacher' => Inertia::location(route('filament.admin.resources.projects.index')),
            default => redirect('/'),
        };
    }
}
