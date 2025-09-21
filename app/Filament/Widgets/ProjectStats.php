<?php

namespace App\Filament\Widgets;

use App\Models\Enrollment;
use App\Models\Cycle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Project;
use App\Models\User;


class ProjectStats extends BaseWidget
{
    protected  ?string $pollingInterval = '2s';


    protected function getStats(): array
    {
        return [
            Stat::make(__('Ciclos'), Cycle::count())
                ->description(__('Ciclos formativos'))
                ->color('success')
                ->icon('heroicon-o-user-plus')
                ->url(route('_filament.admin.resources.cycles.index'))  // ⬅️ Aquí el enlace
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make(__('Proyectos'), Project::count())
                ->description(__('Total de proyectos registrados'))
                ->color('primary')
                ->icon('heroicon-o-folder')
                ->chart(["inform"=>7, "Comercio"=>2, 10, 3, 15, 4, 100])
                ->url(route('_filament.admin.resources.projects.index'))  // ⬅️ Aquí el enlace
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make(__('Profesores'), User::role("teacher")->count())
                ->description(__('Profesores en la plataforma'))
                ->color('primary')
                ->icon('heroicon-o-academic-cap')
                ->url(route('_filament.admin.resources.users.index'))  // ⬅️ Aquí el enlace
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make(__('Matrículas'), Enrollment::count())
                ->description(__('Matrículas activas'))
                ->color('primary')
                ->icon('heroicon-o-book-open')
                ->url(route('_filament.admin.resources.enrollments.index'))  // ⬅️ Aquí el enlace
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make(__('Alumnos'), User::role("student")->count())
                ->description(__('Alumnos totales'))
                ->color('primary')
                ->icon('heroicon-o-user-plus')
                ->url(route('_filament.admin.resources.users.index'))  // ⬅️ Aquí el enlace
                ->extraAttributes(['class' => 'cursor-pointer']),



            //


        ];
    }
}
