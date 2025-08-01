<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use const App\Http\Controllers\teacher;

class TeacherController extends Controller
{
    public function index(Request $request): Response
    {
        $teachers = Teacher::where('role=teacher', $role="teacher")->get();
    }

    public function show(Request $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);
    }

    public function update(TeacherUpdateRequest $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);

        $teacher->update($request->validated());
    }

    public function destroy(Request $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);

        $teacher->delete();
    }
}
