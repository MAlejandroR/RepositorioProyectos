<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Socialite;
use Illuminate\Support\Str;



class HandlerProviderCallback extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        $solciaUser=Socialite::driver($provider)->stateless()->user();

        $user=User::where("email", $solciaUser->getEmail())->first();
        if (!$user) {
            $user=User::create(
                ["name" =>$solciaUser->getName(),
                 "email"=>$solciaUser->getEmail(),
                 "password" => Hash::make(Str::random(16)),
                ]);
            // Assign role based on email
            $user->sendEmailVerificationNotification(); //

            $email=$user->email;

            if ($email === 'admin@gmail.com') {
                $role='admin';
            } elseif (Str::endsWith($email, '@cpilosenlaces.com')) {
                $role='teacher';
            } else {
                $role='student';
            }

            $user->assignRole($role); // Spatie
        }

        Auth::login($user);

        $rol=$user->getRoleNames()->first();


        // al final del método
        return Inertia::location(match ($rol) {
            'admin' => '/admin',
            'teacher' => '/teacher',
            'student' => '/student',
            default => '/',
        });
    }
}
