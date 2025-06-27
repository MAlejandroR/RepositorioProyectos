<?php
namespace App\Http\Responses;

use Inertia\Inertia;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomRegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();
        $rol = $user->getRoleNames()->first();
        info(__CLASS__."@".__METHOD__.": de $user->name, con rol $rol");


        return match ($rol) {
            //'admin' => redirect('/admin'),
            'admin' => Inertia::location('/admin'),
            //'admin' => redirect()->away('https://google.com'),
            'student' => Inertia::location('/student'),
            'teacher' => Inertia::location('/teacher'),
            default => redirect('/'),
        };
    }
}

?>
