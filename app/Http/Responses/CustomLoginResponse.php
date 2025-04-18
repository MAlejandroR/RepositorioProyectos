<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse;
use Inertia\Inertia;

class CustomLoginResponse implements LoginResponse
{
    public function toResponse($requexst)
    {

        $user = auth()->user();

//        if (!$user->is_verified) {
//            return redirect('/verify-code');
//        }

        $rol = $user->getRoleNames()->first();
        info("CustomLoginResponse@toResponse user: $user->name - role: -$rol-");

        return match ($rol) {
            //'admin' => redirect('/admin'),
            'admin' => Inertia::location('/admin'),
            //'admin' => redirect()->away('https://google.com'),
            'student' => redirect('/dashboard/student'),
            'teacher' => redirect('/dashboard/teacher'),
            default => redirect('/'),
        };
    }
}
