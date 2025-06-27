<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $query = strtolower($request->input('question'));
        info(__CLASS__. " $query");
// Limpiar comas, poner espacios para que Algolia entienda cada palabra separada
        $cleanedQuery = str_replace(',', ' ', $query);

        // Opcional: bajar a minúsculas para evitar mayúsculas/minúsculas (Algolia suele ser case-insensitive)
        $cleanedQuery = strtolower($cleanedQuery);
        $projects = Project::search($query)->get();
        info($projects);
//        $projects = Project::query();

//        if (str_contains($query, 'informática')) {
//            $projects->where('familia_profesional', 'like', '%informática%');
//        }
//
//        if (str_contains($query, 'mongo')) {
//            $projects->where('palabras_clave', 'like', '%mongo%');
//        }
//
//        if (str_contains($query, 'laravel')) {
//            $projects->where('palabras_clave', 'like', '%laravel%');
//        }

// Puedes seguir añadiendo más reglas simples como estas

        // Devolver solo algunos campos como resultado
        return response()->json([
            'results' => $projects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'titulo' => $project->titulo,
                    'familia_profesional' => $project->familia_profesional,
                    'palabras_clave' => $project->palabras_clave,
                    'enlace_recursos' => $project->enlace_recursos
                ];
            })->values(),
        ]);
        info ("En chat bot");
        info ($projects->toArray());
        return response()->json([
            'results' => $projects->get(['id', 'titulo', 'familia_profesional', 'palabras_clave','enlace_recursos']),
        ]);

    }
}

?>
