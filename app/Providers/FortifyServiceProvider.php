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
use App\Http\Responses\CustomLoginResponse as CustomValidateRequest;
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
        env('DEBUG_AUTH') && info('⚠️ Ejecutando FortifyServiceProvider boot');

        env('DEBUG_AUTH_ADMIN') && info(__CLASS__."@".__METHOD__.": Con url ".request()->path());

        env('DEBUG_AUTH') && info( request()->input());


        //Establecer la pantalla en caso de logín
// 👤 Vista personalizada para el login
        Fortify::loginView(function () {
            return Inertia::render('Welcome', [
                'departaments' => config('departaments'),
            ]);
        });

        Fortify::registerView(function () {
            return Inertia::render('Welcome', [
                'departaments' => config('departaments'),
            ]);
        });


        //Cuando me registro
        Fortify::createUsersUsing(CreateNewUser::class);
        env('DEBUG_AUTH') && info(__CLASS__."@".__METHOD__.": Next Create New User");


//        info("FortityServiceProvider->boot antes de  autenticateUsing");

        //Cuando me autentico, debo retornar el usuario autenticado o null
        Fortify::authenticateUsing(function (Request $request){

            env('DEBUG_AUTH') &&  info(__CLASS__."@".__METHOD__.": antes de buscar uusario");
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return null; // Usuario no existe, fallar login
            }
            env('DEBUG_AUTH') && info(__CLASS__."@".__METHOD__.": Usuario encontrado $user");
            // ✅ Si el usuario no tiene contraseña aún, lo dejamos pasar

            if (is_null($user->password)) {
                return $user;
            }

            // ✅ Si tiene contraseña, la verificamos como siempre
            if (Hash::check($request->password, $user->password)) {
                return $user;
            }


//            if ($user && Hash::check($request->password, $user->password)) {
//                // login ok (Credenciales válidas)
//                // aqui añadiría si quiero hacer más cosas una vez logueado ok
//                return $user;
//            }
            // Login no ok !!  Credenciales inválidas
            return null;
        });


        //$this->app->instance(LoginResponse::class, new CustomLoginResponse());

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


      /*
          info("Antes de  confirmPasswordView");

        Fortify::confirmPasswordView(function () {
            info(__CLASS__."@".__METHOD__.": antes de inertia render");
            return Inertia::render('Auth/VerifyEmail');

        }
        );
*/

        Fortify::verifyEmailView(function () {
            env('DEBUG_AUTH_VERIFY_EMAIL') &&  info(__CLASS__."@".__METHOD__.": antes de inertia render");
            return Inertia::render('Auth/VerifyEmail');

        }
        );


        info(__CLASS__."@".__METHOD__.": Fin de método ");



    }


    public function register(): void
    {
        //       info("FortifyServiceProvider->register");

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
        $this->app->bind(LoginRequest::class,  CustomValidateRequest::class);

        $this->app->instance(LoginResponseContract::class, new CustomLoginResponse());

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });
        $this->app->bind(AttemptToAuthenticate::class, CustomAttemptToAuthenticate::class);


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
