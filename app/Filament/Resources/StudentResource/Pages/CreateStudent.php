<?php

namespace App\Filament\Clusters\Usuarios\Resources\StudentResource\Pages;

use App\Filament\Clusters\Usuarios\StudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
}
