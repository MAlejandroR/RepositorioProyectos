<?php

namespace App\Filament\Clusters\Usuarios\Resources\StudentResource\Pages;

use App\Filament\Clusters\Usuarios\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
