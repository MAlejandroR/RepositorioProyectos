<?php

namespace App\Providers\Filament;

use App\Filament\Resources\CycleResource;
use App\Filament\Resources\EnrollmentResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\UserResource;
use App\Http\Middleware\ConditionalInertiaMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
//        //Aquí estableceremos los recursos que serán en función del rol
//        //De momento teacher puede acceder solo a projects
//        //admin a todos
//        $resources = [];
//
//        if (auth()->check()) {
//            $user = auth()->user();
//            if ($user->hasRole('admin')) {
//                $resources = [
//                    ProjectResource::class,
//                    CycleResource::class .
//                    EnrollmentResource::class,
//                    UserResource::class
//                ];
//            }
//            if ($user->hasRole('teahcer')) {
//                $resources = [
//                    ProjectResource::class
//                ];
//            }
//        }
        info(__CLASS__." con user -".auth()->user()."-");
        return $panel
            ->id('admin')
            ->path('admin')
            ->brandName(__('panel.project_repository'))
            ->renderHook('panels::topbar.end', fn() => view('components.language-switcher'))
            ->colors([
                'primary' => Color::Amber,
            ])
//            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
//            ->when(auth()->check() && auth()->user()->hasRole('admin'), function ($panel) {
//                info("en panel filament soy admin");
//                return $panel->discoverResources(
//                    in: app_path('Filament/Resources'),
//                    for: 'App\\Filament\\Resources'
//                );
//            })
//            ->resources([
//                \App\Filament\Resources\ProjectResource::class,
//            ])
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\HandleLanguage::class, // <-- añade aquí también
                ConditionalInertiaMiddleware::class,
            ])
            ->authMiddleware([Authenticate::class, \App\Http\Middleware\RestrictTeacherOnlyAdminProject::class]

            );
    }
}
