<?php
// app/Http/Controllers/ProjectSearchController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Project::query();

        if ($request->filled('ciclo_formativo')) {
            $query->where('ciclo_formativo', $request->input('ciclo_formativo'));
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->input('titulo') . '%');
        }

        if ($request->filled('palabra_clave')) {
            $query->where('palabras_clave', 'like', '%' . $request->input('palabra_clave') . '%');
        }

        return response()->json($query->limit(20)->get());
    }
}
