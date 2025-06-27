<?php
// app/Http/Requests/CustomLoginRequest.php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\User;

class CustomLoginRequest extends LoginRequest
{
    public function rules()
    {
        $rules = parent::rules();
        dd($rules);

        $email = $this->input('email');
        $user = User::where('email', $email)->first();

// Si el usuario no tiene contraseña, quitamos la validación obligatoria
        if ($user && is_null($user->password)) {
            unset($rules['password']);
        }

        return $rules;
    }
}
