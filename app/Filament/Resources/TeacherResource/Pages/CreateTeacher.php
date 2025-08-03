<?php

namespace App\Filament\Clusters\Usuarios\Resources\TeacherResource\Pages;

use App\Filament\Clusters\Usuarios\TeacherResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
}
