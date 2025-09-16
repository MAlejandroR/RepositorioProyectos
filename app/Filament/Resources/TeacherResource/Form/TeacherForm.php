<?php

namespace App\Filament\Resources\TeacherResource\Form;

use Filament\Schemas\Schema;
use App\Models\Family;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\TeacherResource\Pages\ListTeachers;
use App\Filament\Resources\TeacherResource\Pages\CreateTeacher;
use App\Filament\Resources\TeacherResource\Pages\EditTeacher;
use App\Models\Cycle;
use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class TeacherForm extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-plus';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestión de Datos';
    protected static ?string $navigationParentItem = "Usuarios ▾";
    protected static ?string $navigationLabel = "Estudiantes";


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label("Nombre")
                ,
                TextInput::make('surname_1')->required()->maxLength(255)->label("Apellido 1"),
                TextInput::make('surname_2')->required()->maxLength(255)->label("Apellido 2"),
                TextInput::make('email')->email()->required()->maxLength(255)->label("Email"),
                //TODO
                //Quiero mostrar ciclos y una vez que se vean familias,
                //Solo las familias disponibles en este centro!!
                //
                // mostrar los familias mostrar los ciclos
                Select::make('family_id')
                    //->relationship('cycles', 'name')
                    ->options(function () {
                        $query = Family::query();
                        $query->has("cycles.enrollments");
                        return $query->pluck('name', 'id');
                    })
                    ->label("Familia profesional")
                    ->reactive() //Cuando el valor cambia, se ejecutan las funciones e clousura
                    ->afterStateUpdated(fn($set) => $set("cycle_id", null))
                    ->required(),
                Select::make('cycle_id')
                    ->label("Ciclo Formativo")
                    ->options(function (callable $get) {
                        $family_id = $get('family_id');
                        if (!$family_id) {
                            return [];
                        }
                        return Cycle::where('family_id', $family_id)
                            ->orderBy('name')
                            ->pluck('name', 'id');
                    })
                    ->required()
                    ->reactive()
                    ->hidden(fn (callable $get) => !$get('family_id')) // oculto hasta que haya family

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Nombre")
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                TextColumn::make('full_surnames')
                    ->getStateUsing(fn($record) => "{$record->surname_1} {$record->surname_2}")
                    ->label("Apellidos")
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                TextColumn::make('cycles.family.name')
                    ->searchable()
                    ->label("Ciclo Matriculado")
                    ->sortable()
                    ->limit(30)
                    ->wrap(), // permite salto de línea para evitar que se estire
                //
            ])
            //
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListTeachers::route('/'),
            'create' => CreateTeacher::route('/create'),
            'edit' => EditTeacher::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas("roles", fn(Builder $query) => $query->where('name', 'teacher'));; // TODO: Change the autogenerated stub
    }

}
