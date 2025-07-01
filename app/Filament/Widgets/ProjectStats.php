<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Project;
use App\Models\User;

class ProjectStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Proyectos'), Project::count()),
            Stat::make(__('Profesores'), User::role("teacher")->count()),
            //
        ];
    }
}
