<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        info ("CreateNewUser @ create");
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        info ("CreateNewUser - Next validate");


        $user= User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        // Asignar rol en función del dominio del correo electrónico
        info(" CreateNewUser con email ". $input['email']);
        $emailDomain = substr(strrchr($input['email'], "@"), 1);
        info ("CreateNewUser -$emailDomain-");

        if ($emailDomain === 'cpilosenlaces.com') {
            info ("Asignando teacher");
            $user->assignRole('teacher');
        } else {
            info ("Asignando student");
            $user->assignRole('student');
        }
        return $user;
    }


}
