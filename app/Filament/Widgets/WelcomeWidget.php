<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.welcome-widget';
    protected static ?string $heading = 'Welcome to the Admin Panel';
    protected static ?string $group = 'Admin';
    protected static ?int $sort = 1;
}
