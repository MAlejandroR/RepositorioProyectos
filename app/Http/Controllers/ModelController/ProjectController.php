<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use App\Models\Family;
use App\Models\Cycle;

class ProjectController extends Controller
{
    public function index(Request $request): Response
    {
        $projects = Project::all();
    }

    public function show(Request $request, Project $project): Response
    {
        $project = Project::find($id);
    }

    public function store(ProjectStoreRequest $request): Response
    {
        $project = Project::create($request->validated());
    }

    public function update(ProjectUpdateRequest $request, Project $project): Response
    {
        $project = Project::find($id);

        $project->update($request->validated());
    }

    public function destroy(Request $request, Project $project): Response
    {
        $project = Project::find($id);

        $project->delete();
    }
    public function teacher_query(Request $request){
        $projects = Project::all();
        $families = Family::all();
        $cycles = Cycle::all();
        info(__CLASS__."@".__METHOD__);
        info($projects);
        info($cycles);
        info($families);

        return Inertia::render("Dashboard/Teacher/Index",compact("projects","families","cycles","projects"));
    }
}
