<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TeacherResource extends Resource
{
    protected static ?string $model = User::class;



    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Gestión de Datos';
    protected static ?string $navigationParentItem = "Usuarios ▾";
    protected static ?string $navigationLabel ="Teacher";


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
            'index' => \App\Filament\Resources\TeacherResource\Pages\ListTeachers::route('/'),
            'create' => \App\Filament\Resources\TeacherResource\Pages\CreateTeacher::route('/create'),
            'edit' => \App\Filament\Resources\TeacherResource\Pages\EditTeacher::route('/{record}/edit'),
        ];


    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('roles', function($query) {
                $query->where('name', 'teacher');
            });
    }
    public static function getModelLabel(): string
    {
        return 'Teacher'; // singular label
    }

    public static function getPluralModelLabel(): string
    {
        return 'Teachers'; // plural label
    }

}
