<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\AttemptToAuthenticate;
use Laravel\Fortify\Events\Lockout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class CustomAttemptToAuthenticate implements AttemptToAuthenticate
{
    public function handle(Request $request)
    {
        $email = $request->input('email');
        $user = \App\Models\User::where('email', $email)->first();

        // Si el usuario no tiene contraseña, permitimos login sin validarla
        if ($user && is_null($user->password)) {
            return $user;
        }

        // Si tiene contraseña, validamos que se haya enviado
        if (!$request->filled('password')) {
            throw ValidationException::withMessages([
                'password' => __('El campo contraseña es obligatorio.'),
            ]);
        }

        return null; // Fortify seguirá con el flujo normal
    }
}
