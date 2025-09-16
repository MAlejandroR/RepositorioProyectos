<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Schemas\Schema;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Models\User;


class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    //Icono para navegar
    protected static string | \BackedEnum | null  $navigationIcon = 'heroicon-o-link';

//    protected static string | \BackedEnum | null  $navigationIcon = 'heroicon-o-document-text';
//    protected static string| \UnitEnum | null $navigationGroup = __('Gestión de Datos');
//    protected static ?string $modelLabel = __('Proyecto');
//    protected static ?string $pluralModelLabel = __('Proyectos');

    public static function getNavigationGroup(): ?string
    {
        return __('Gestión de Datos');
    }

    public static function getModelLabel(): string
    {
        return __('Proyecto');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Proyectos');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('titulo')->required()->maxLength(255),
            Forms\Components\TextInput::make('autor')->required()->maxLength(255),
            Forms\Components\TextInput::make('correo_autor')->email()->required()->maxLength(255)
                ->label("Email")
            ,
            Forms\Components\TextInput::make('familia_profesional')
                ->label("Familia Profesional")
                ->required()
                ->maxLength(255)
                ->reactive(), //Filament vuelve a ejecutar dinámicamente las callbacks dependientes cada vez que el campo cambia.
            Forms\Components\TextInput::make('ciclo_formativo')->required()->maxLength(255)
                ->label("Ciclo Formativo"),
            Forms\Components\Textarea::make('resumen')->required()->rows(5),
            Forms\Components\TextInput::make('curso_academico')->required()->maxLength(255),
            Forms\Components\TextInput::make('palabras_clave')->maxLength(255),
            Forms\Components\TextInput::make('area_tematica')->required()->maxLength(255),
            Forms\Components\TextInput::make('enlace_recursos')->url()->maxLength(255),
            Forms\Components\Textarea::make('comentarios_profesor')->rows(3),
            Forms\Components\Select::make('enrollment_id')
                ->relationship('enrollment', 'id')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('teacher_id')
                ->label("Profesor")
                ->relationship('teacher', 'name')
                ->searchable()
                ->required()
                ->options(function (callable $get) {
                    $departamento = $get('familia_profesional');
                    if (!$departamento) {
                        return [];
                    }
                    return User::where('departament', $departamento)
                        ->pluck('name', 'id');
                }),
            Forms\Components\TextInput::make('enrollment_user_id')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('titulo')
                ->searchable()
                ->sortable()
                ->limit(30)
                ->wrap(), // permite salto de línea para evitar que se estire
            Tables\Columns\TextColumn::make('autor')
                ->sortable()
                ->searchable()
                ->limit(20)
                ->wrap(),
            Tables\Columns\TextColumn::make('familia_profesional')
                ->sortable()
                ->searchable()
                ->label("Familia")
                ->limit(20)
                ->wrap(), // Añadido
            Tables\Columns\TextColumn::make('ciclo_formativo')
                ->sortable()
                ->searchable()
                ->limit(25)
                ->wrap(), // Añadido
            Tables\Columns\TextColumn::make('curso_academico')
                ->sortable()
                ->label('Curso'),
        ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(fn(Project $record) => "Detalles del proyecto:($record->titulo)")
                    ->modalFooterActions([
                        Tables\Actions\Action::make('print')
                            ->label('🖨️ Imprimir / PDF')
                            ->color('gray')
                            ->action(fn() => null) // No hace nada en backend
                            ->extraAttributes([
                                'onclick' => 'window.print()',
                            ]),
                        Tables\Actions\Action::make('close')
                            ->label('Cerrar')
                            ->color('gray')
                            ->close()
                    ]),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make("goToProjects")
                    ->label("Acceder")
                    ->icon("heroicon-o-link")
                    ->color("info")
                    ->url(fn(Project $record) => $record->enlace_recursos)
                    ->openUrlinNewTab()

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {

        return auth()->user()->hasRole(['admin', 'teacher']);
    }
    public static function canCreate(): bool
    {

        return auth()->user()->hasRole(['admin', 'teacher']);
    }
    public static  function getNavigationLabel(): string{
        return __("Proyectos");
    }
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole(['admin', 'teacher']);
    }
}
