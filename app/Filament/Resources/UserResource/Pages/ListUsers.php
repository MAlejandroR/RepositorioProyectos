<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use League\Csv\Reader;
use App\Models\User;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('importCsv')
                ->label(__('Import CSV'))
                ->form([
                    FileUpload::make('files')
                        ->label('Selecciona archivo CSV')
                        ->required()
                        ->acceptedFileTypes(['text/csv'])
                        ->multiple()
                        ->disk('public') // Guardamos en storage/app/public
                        ->directory('storage/filament') // Carpeta interna
                        ->preserveFilenames(), // Para que el nombre sea predecible (opcional)
                ])
                ->action(function (array $data) {
                    $uploadedFiles = $data['files']??[]; //Recojo todos los ficheros
                    $totalImported=0;
                    $totalSkipped=0;


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
                        //Apellido 1, Apellido 2, Nombre, Especialidad, Email


                        $imported = 0; //Control de importados
                        $skiped = 0; // control de repetidos

                        foreach ($records as $row) {


                            $exists = User::where("email", $row[$headers[4]])
                                ->exists();
                            if ($exists) {
                                $skiped++;
                                continue;
                            }




                            $user=\App\Models\User::create([
                                'name' => $row[$headers[2]],
                                'surname_1' => $row[$headers[0]],
                                'surname_2' => $row[$headers[1]],
                                'email' => $row[$headers[4]],
//                                'password' => "12345678", no ponemos valor
                                'departament' => $row[$headers[3]],
                            ]);
                            $user->assignRole("teacher");

                            $imported++;
                        }
                        $totalImported++;


                        Notification::make()
                            ->title(__("Se han importado $imported usuarios profesores"))
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
        ];
    }
}
