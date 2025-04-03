<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Models\User;
use Inertia\Inertia;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */


    /**
     * Bootstrap any application services.
     * Este método boot,
     */
    public function boot(): void
    {
        info("FortifyServiceProvider->boot");
        info(auth()->user());

        //Establecer la pantalla en caso de logín
// 👤 Vista personalizada para el login
        Fortify::loginView(function () {
            return Inertia::render('Welcome');
        });

        Fortify::registerView(function () {
           return Inertia::render('Welcome');
        });


        //Cuando me registro
        Fortify::createUsersUsing(CreateNewUser::class);

        //Cuando me autentico, debo retornar el usuario autenticado o null
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            info("FortityServiceProvider->boot en autenticateUsing");
//            info ("-$user-");

            if ($user && Hash::check($request->password, $user->password)) {
                // Credenciales válidas, puedes agregar más lógica aquí
                return $user;
            }
            // Credenciales inválidas
            return null;
        });


        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
//            info("FortityServiceProvider->for(login)");
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //Verificación por password
        Fortify::confirmPasswordView(function () {
//            info("te quiero ver");
            return Inertia::render('Auth/VerifyEmail');
        });

    }


    public function register(): void
    {
        info("FortifyServiceProvider->register");

        /*
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                session()->flash('flash.banner', 'Probando probando banner!');
                session()->flash('flash.bannerStyle', 'success');
                return redirect('/listado');
            }
        });
        */
//        $this->app->instance(LoginResponse::class, new CustomLoginResponse());

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });

    }

    public function redirectTo(): string
    {
        $rol = auth()->user()->getRoleNames()->first();
        info("fortifyServiceProvider->redirectTo($rol)");
        switch ($rol) {
            case 'admin':
                return '/admin';
            case'teacher':
                return '/teacher';
            case 'student':
                return '/student';

        }
        return ("/");
    }
}
