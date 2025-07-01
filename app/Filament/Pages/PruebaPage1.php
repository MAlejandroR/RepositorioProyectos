<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PruebaPage1 extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.prueba-page1';
    public static function canAccess(): bool
    {
        return true;
    }
}
