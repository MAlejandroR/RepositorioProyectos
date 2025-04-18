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
use App\Http\Responses\CustomLoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
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
            info("FortityServiceProvider->boot en loginView");
            return Inertia::render('Welcome');
        });

        Fortify::registerView(function () {
            info("FortityServiceProvider->boot en registerView");
           return Inertia::render('Welcome');
        });


        //Cuando me registro
        Fortify::createUsersUsing(CreateNewUser::class);

        info("11");
        //Cuando me autentico, debo retornar el usuario autenticado o null
        Fortify::authenticateUsing(function (Request $request) {
            info("FortityServiceProvider->boot en autenticateUsing");
            $user = User::where('email', $request->email)->first();
            info("FortityServiceProvider->boot en autenticateUsing");
            info ("-$user-");

            if ($user && Hash::check($request->password, $user->password)) {
                // Credenciales válidas, puedes agregar más lógica aquí
                return $user;
            }
            // Credenciales inválidas
            return null;
        });
        info("12");

        //$this->app->instance(LoginResponse::class, new CustomLoginResponse());

        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        info("13");

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
        info("14");

    }


    public function register(): void
    {
        info("FortifyServiceProvider->register");

        /*
        $this->app->instance(CustomLoginResponse::class, new class implements CustomLoginResponse {
            public function toResponse($request)
            {
                session()->flash('flash.banner', 'Probando probando banner!');
                session()->flash('flash.bannerStyle', 'success');
                return redirect('/listado');
            }
        });
        */
        $this->app->instance(LoginResponseContract::class, new CustomLoginResponse());

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });

    }

//    public function redirectTo(): string
//    {
//        $rol = auth()->user()->getRoleNames()->first();
//        info("fortifyServiceProvider->redirectTo($rol)");
//        switch ($rol) {
//            case 'admin':
//                return '/admin';
//            case'teacher':
//                return '/teacher';
//            case 'student':
//                return '/student';
//
//        }
//        return ("/");
//    }
}
