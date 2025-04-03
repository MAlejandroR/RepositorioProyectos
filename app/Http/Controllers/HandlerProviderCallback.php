<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Services\OtpService;

class HandlerProviderCallback extends Controller
{
    /**
     * Handle the social login callback.
     *
     * @param string $provider The social provider (e.g., 'google', 'github', 'slack').
     */
    public function __invoke(string $provider)
    {
        $socialUser = $this->getSocialUser($provider);
        $user = $this->findOrCreateUser($socialUser);

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    /**
     * Get the user data from the social provider.
     */
    private function getSocialUser(string $provider)
    {

        return Socialite::driver($provider)->stateless()->user();
    }

    /**
     * Find existing user or create a new one.
     */
    private function findOrCreateUser($socialUser): User
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
            ]);

            app(OtpService::class)->sendOtp($user);


            $this->assignRoleByEmail($user);
        }

        return $user;
    }

    /**
     * Assign a role to the user based on email.
     */
    private function assignRoleByEmail(User $user): void
    {
        $email = $user->email;

        $role = match (true) {
            $email === 'admin@gmail.com' => 'admin',
            Str::endsWith($email, '@cpilosenlaces.com') => 'teacher',
            default => 'student',
        };

        $user->assignRole($role);
    }

    /**
     * Redirect user based on role.
     */
    private function redirectByRole(User $user)
    {
        $role = $user->getRoleNames()->first();


        return Inertia::location(match ($role) {
            'admin' => '/admin',
            'teacher' => '/teacher',
            'student' => '/student',
            default => '/',
        });
    }
}
