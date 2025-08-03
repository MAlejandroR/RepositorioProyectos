<?php

namespace App\Filament\Clusters\Usuarios\Resources\GuestResource\Pages;

use App\Filament\Clusters\Usuarios\GuestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGuest extends CreateRecord
{
    protected static string $resource = GuestResource::class;
}
