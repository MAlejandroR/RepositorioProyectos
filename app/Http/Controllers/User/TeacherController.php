<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Project;
use App\Models\Teacher;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        //Protección si estoy auth, reenviar al sitio correcto, ya que puede ser que estuviera login como otro rol


/*
        //** aquí sería la opción de recuperar los proyectos que hay en google
        Esta interesante funciónalidad la dejo pendiente
        try {
            $projects = app(GoogleDriveService::class)->listFolder();

        } catch (\Exception $exception) {
            session()->put("redirect_after_google_auth", url()->current());
            if ($request->header('X-Inertia')) {
                // Petición Inertia: usar redirección compatible
                return Inertia::location('/auth/google');
            }
        // Petición normal (no Inertia)
            return redirect('/auth/google');
        }
        dd(__CLASS__."@".__METHOD__.": url ".request()->url());
        */
        $projects = Project::all();

        return Inertia::render('Dashboard/Teacher/Index');

        //Muy importante esta ruta es para acceder a parte de filament (solo a proyectos)
        /*
        return Inertia::location(route('filament.admin.resources.projects.index'));
        */





    }

    public function show(Request $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);
    }

    public function update(TeacherUpdateRequest $request, Teacher $teacher): Response
    {


        $teacher->update($request->validated());
    }

    public function destroy(Request $request, Teacher $teacher): Response
    {

        $teacher->delete();

    }
}
