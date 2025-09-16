<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Schema;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

//    protected static string | \BackedEnum | null  $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-plus';
    protected static string| \UnitEnum | null  $navigationGroup = 'Gestión de Datos';
    protected static ?string $navigationLabel ="Usuarios ▾";
/*
    public static function getNavigationLabel(): string
    {
        return __("Usuarios");
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Gestión de Datos');
    }
*/
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                ->label("Nombre")
                ,
                Forms\Components\TextInput::make('surname_1')->required()->maxLength(255)->label("Apellido 1"),
                Forms\Components\TextInput::make('surname_2')->required()->maxLength(255)->label("Apellido 2"),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255)->label("Email"),
                Forms\Components\Select::make('specialization_id')
                    ->relationship('specialization', 'name')
                    ->label("Especialidad")
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Nombre")
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('full_surnames')
                    ->getStateUsing(fn($record) => "{$record->surname_1} {$record->surname_2}")
                    ->label("Apellidos")
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('specialization.family.name')
                    ->searchable()
                    ->label("Departamento")
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                //
            ])
            //

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
            'index' => \App\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \App\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \App\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {

        return auth()->user()->hasRole(['admin']);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole(['admin']);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['specialization.family']);
    }
}
