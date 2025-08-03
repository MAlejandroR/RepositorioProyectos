<?php

namespace App\Filament\Clusters\Usuarios\Resources\GuestResource\Pages;

use App\Filament\Clusters\Usuarios\GuestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuests extends ListRecords
{
    protected static string $resource = GuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
