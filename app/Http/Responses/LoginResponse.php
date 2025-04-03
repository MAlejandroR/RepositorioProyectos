<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements  LoginResponseContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
     public function toResponse($request){
        $user = auth()->user();
        if (!user->is_verified){
            return redirect('/verify-code');
        }
        $rol = $user->getRoleNames()->first();
        info("LoginResponse@toReponse user- $user->name- rol -$rol- ");
        return match ($rol) {
            "admin"=> redirect('dashboard/admin'),
            "student"=> redirect('dashboard/student'),
            "teacher"=> redirect('dashboard/teacher'),
        };
        return redirect ("/");
     }
}
