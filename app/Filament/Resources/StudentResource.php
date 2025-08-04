<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'Gestión de Datos';
    protected static ?string $navigationParentItem = "Usuarios ▾";
    protected static ?string $navigationLabel ="Estudiantes";


    public static function form(Form $form): Form
    {
        return $form
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
                    ->options(function(){
                        $query = \App\Models\Specialization::query();

                        if ($familyId = request('family_id')) {
                            $query->where('family_id', $familyId);
                        }

                        return $query->pluck('name', 'id');
                    })
                    ->label("Especialidad")
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
            'index' => \App\Filament\Resources\StudentResource\Pages\ListStudents::route('/'),
            'create' => \App\Filament\Resources\StudentResource\Pages\CreateStudent::route('/create'),
            'edit' => \App\Filament\Resources\StudentResource\Pages\EditStudent::route('/{record}/edit'),
        ];
    }

}
