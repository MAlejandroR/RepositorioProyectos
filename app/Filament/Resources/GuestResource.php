<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Schemas\Schema;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuestResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user';
    protected static string| \UnitEnum | null $navigationGroup = 'Gestión de Datos';
    protected static ?string $navigationParentItem = "Usuarios ▾";
    protected static ?string $navigationLabel ="Usuario Invitado";


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\GuestResource\Pages\ListGuests::route('/'),
            'create' => \App\Filament\Resources\GuestResource\Pages\CreateGuest::route('/create'),
            'edit' => \App\Filament\Resources\GuestResource\Pages\EditGuest::route('/{record}/edit'),
        ];
    }

}
