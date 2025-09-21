<?php

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;
use function Livewire\Livewire\livewire;
use Livewire\Livewire;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Filament\Facades\Filament;



//it('has importprojectscsv page', function () {
//    $response = $this->get('/importprojectscsv');
//
//    $response->assertStatus(200);
//});
beforeEach(function(){
    Role::findOrCreate("admin");
    Role::findOrCreate("student");

    Role::findOrCreate("teacher");
});

it("Solo admin puede importar ficheros csv", function(){
    //Creamos un usuario
    $user =User::factory()->create();
    $user->assignRole('student'); //Asignamos otro rol
    //Simulamos con actingAs que el usuario ha iniciado de forma correcta la sesión
    actingAs($user); //A partir de este momento $user está autenticado
    $response = get("/admin/projects"); //Accedo a esta ruta
    $response->assertForbidden();//Obtengo un forbidden
    //\Pest\Laravel\actingAs($user)->get('"admin/projects"')->assertForbidden(403);


});
it("Si subo un fichero con un nombre, se guarda en la carpeta", function(){
    // Crear usuario admin y me logueo
    $user = User::factory()->create();
    $user->assignRole('admin');
    actingAs($user);

    // Simular almacenamiento
    Storage::fake('public');

    // Crear archivo CSV falso
    $file = UploadedFile::fake()->create('projects.csv', 100, 'text/csv');

    // Inicializar el panel manualmente si estás usando Filament 3
    Filament::setCurrentPanel(Filament::getPanel('admin'));

    // Ejecutar la acción del componente
    Livewire::test(\App\Filament\Resources\ProjectResource\Pages\ListProjects::class)
        ->callAction('importCsv', data: ['file' => $file]);

    // Verificar que se guardó el archivo
    Storage::disk('public')->assertExists('_filament/' . $file->hashName());

});
//it("Allows admin to import CSV file and cretes  projets", function(){
////Creamos el rol si no existe
//    Role::findorCreate("admin");
//
//
//
//
//});
