<?php

namespace App\Filament\Clusters\Usuarios\Resources\UserResource\Pages;

use App\Filament\Clusters\Usuarios\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
