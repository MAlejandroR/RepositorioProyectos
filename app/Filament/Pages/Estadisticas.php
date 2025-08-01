<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Estadisticas extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estadisticas';
    protected static ?string $title= "Estadísticas";


    public static function getNavigationLabel(): string{
        return __("Estadísticas");
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(['admin']);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole(['admin']);
    }
    //Para el título traducido, también podría el atributo $title, pero ahí no puedo traducir
    public function getHeading(): string
    {

        return __("Estadísticas");
    }


}
