<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
