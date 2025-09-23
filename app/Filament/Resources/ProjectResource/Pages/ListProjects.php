<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Models\Project;
use League\Csv\Reader;


class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {

        //return dd("Estoy en jetHeaderActions")
        return [
//            Actions\CreateAction::make(),
            Actions\Action::make('importCsv')
                ->label(__('Import CSV'))
                ->form([
                    FileUpload::make('files')
                        ->label('Selecciona archivo CSV')
                        ->required()
                        ->acceptedFileTypes(['text/csv'])
                        ->multiple()
                        ->disk('public') // Guardamos en storage/app/public
                        ->directory('/storage/filament') // Carpeta interna
                        ->preserveFilenames(), // Para que el nombre sea predecible (opcional)
                ])
                ->action(function (array $data) {
                    $uploadedFiles = $data['files'] ?? []; //Recojo todos los ficheros
                    $totalImported = 0;
                    $totalSkipped = 0;


                    foreach ($uploadedFiles as $nameFile) {


                        //Obtenemos el array con los datos del formulario
//                    $state = $this->form->getState();
//                    $nameFile = $state['file']??"";
//                        $nameFile = $data['file'] ?? null;


                        //Recuperamos el fichero y si no existe informamos de ello

                        if (!file_exists($nameFile)) {
                            Notification::make()
                                ->title(__("file.not.received", ["file" => $nameFile]))
                                ->danger()
                                ->send();
                            return;
                        }

                        $file = storage_path("/app/public/{$nameFile}");
                        if (!file_exists($file)) {
                            Notification::make()
                                ->title(__('file.not.found', ["file" => $file]))
                                ->danger()
                                ->send();
                            return;
                        }

                        //Leer el fichero csv y crear por cada fila, un proyecto
                        /* Usamos funciones de php
                        buenísima str_getcsv que convierte en array un string formato csv
                        file retorna un fichero en array por fila

                        */


                        $csvFile = Reader::createFromPath($file, 'r');
                        $csvFile->setHeaderOffset(0); // if the first row is the headers

                        $records = $csvFile->getRecords(); // iterable
                        //Array indexado con las cabeceras
                        $headers = $csvFile->getHeader();


//        BUENISIMA ESTO ...            $csvFile = array_map("str_getcsv", file($file));
//                    $headers = array_shift($csvFile); //Quitamos primera fila

                        $imported = 0; //Control de importados
                        $skiped = 0; // control de repetidos


//                    foreach ($csvFile as $row) {
                        foreach ($records as $row) {


                            $exists = Project::where("titulo", $row[$headers[0]])
                                ->where("autor", $row[$headers[1]])
                                ->exists();
                            if ($exists) {
                                $skiped++;
                                continue;
                            }


                            \App\Models\Project::create([
                                'titulo' => $row[$headers[0]],
                                'autor' => $row[$headers[1]],
                                'correo_autor' => $row[$headers[2]],
                                'familia_profesional' => $row[$headers[3]],
                                'ciclo_formativo' => $row[$headers[4]],
                                'resumen' => $row[$headers[5]],
                                'curso_academico' => $row[$headers[6]],
                                'palabras_clave' => $row[$headers[7]] ?? null,
                                'area_tematica' => $row[$headers[8]],
                                'enlace_recursos' => $row[$headers[9]] ?? null,
                                'comentarios_profesor' => $row[$headers[10]] ?? null,
                                'enrollment_id' => null,
                                'teacher_id' => null,
                                'enrollment_user_id' => null,
                            ]);

                            $imported++;
                        }
                        $totalImported++;


                        Notification::make()
                            ->title(__("proyectos.importados", ['count' => $imported]))
                            ->success()
                            ->send();
                        if ($skiped > 0)
                            Notification::make()
                                ->title("Se han obviado $skiped registros por estar repetidos")
                                ->success()
                                ->send();
                    }
                    Notification::make()
                        ->title(__("Se han importado en total $totalImported ficheros"))
                        ->success()
                        ->send();


                }
                ),
            Actions\Action::make("consultas")
                ->label("Realizar Consultas Proyectos")
                ->icon("")
//                ->url(fn() => route("teacher.query_projects"))
                ->url(fn() => route("teacher.dashboard"))
                ->openUrlInNewTab()
        ];
    }
}
