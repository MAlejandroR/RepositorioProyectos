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

        info(__CLASS__." con user -".auth()->user()."-");
        return $panel
            ->viteTheme('resources/css/filament/app.css')
            ->id('admin')
            ->path('admin')
            ->brandLogo(asset('images/logo.png'))
            ->brandName(__('panel.project_repository'))
            ->renderHook('panels::body.end', fn() =>view('components.filament.topbar-logo'))
            ->renderHook('panels::body.start', fn() =>view('components.filament.topmenu'))
//            ->renderHook('panels::topbar.start', fn() => view('components.filament.topbar-logo'))
            ->renderHook('panels::topbar.end', fn() => view('components.filament.LanguageSwitcher'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
//                Pages\Dashboard::class,
            \App\Filament\Pages\Dashboard::class,
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
