<?php

namespace App\Filament\Clusters\Usuarios\Resources\UserResource\Pages;

use App\Filament\Clusters\Usuarios\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
