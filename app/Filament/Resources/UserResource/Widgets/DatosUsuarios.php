<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
class DatosUsuarios extends BaseWidget
{
    protected function getStats(): array
    {
        $teachers = User::role("teacher")->count();
        $students = User::role("student")->count();
        $guest = User::count() - $teachers - $students - 1; // 1 por el admin
        return [
            Stat::make('Usuarios Invitados', $guest)
                ->label('Invitados')
                ->color('primary')
                ->icon('heroicon-s-user-minus')
                ->descriptionIcon('heroicon-s-users')
                ->descriptionColor('warning')
//            ->badge("Usuarios con rol de profesor")
//            ->badgeColor('warning')
//            ->tooltip("Numero total de usuarios que son profesores")
                ->url("admin/teachers")

            ,
            Stat::make('Alumnos', $students)
            ->icon('heroicon-s-user-plus')
            ->description("Alumnos del centro")
                ->descriptionIcon('heroicon-m-building-library', IconPosition::Before)
                ->url(route('_filament.admin.resources.students.index'))
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:bg-red-500/80 transition-colors',
                ])

            ,
            Stat::make('Profesores', $teachers)
                ->icon("heroicon-o-academic-cap")
                ->description('Profesores en el centro')
                ->descriptionIcon('heroicon-m-building-library', IconPosition::Before)
                ->url(route('_filament.admin.resources.teachers.index'))
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:bg-red-500/80 transition-colors',
                ])


            //
        ];
    }
}


