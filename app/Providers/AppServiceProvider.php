<?php

namespace App\Providers;

use App\Http\Responses\CustomRegisterResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\CustomLoginResponse;
use App\Http\Responses\LogoutResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Filament\Facades\Filament;
use Laravel\Fortify\Contracts\RegisterResponse;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(LoginResponseContract::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);

		$this->app->bind(
			\App\Interfaces\GoogleDriveServiceInterface::class,
			\App\Services\GoogleDriveService::class
		);

		$this->app->bind(
			\App\Interfaces\GoogleDriveServiceInterface::class,
			\App\Services\GoogleDriveService::class
		);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            app()->setLocale(session('locale', config('app.locale')));
            // Cambia el nombre del panel actual
            Filament::getCurrentPanel()->brandName(__('panel.project_repository'));        });

        //
    }
}
