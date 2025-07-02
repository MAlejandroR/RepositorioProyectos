<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    public static  function getNavigationLabel(): string{
        return __("Usuarios");
    }
    public static function getNavigationGroup(): ?string
    {
        return __('Gestión de Datos');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('surname_1')->required()->maxLength(255),
                Forms\Components\TextInput::make('surname_2')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->required()->maxLength(255),
                Forms\Components\Select::make('departament')
                    ->relationship('departament', 'id')
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('surname_1')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('surname_2')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                Tables\Columns\TextColumn::make('departament')
                    ->searchable()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
}
