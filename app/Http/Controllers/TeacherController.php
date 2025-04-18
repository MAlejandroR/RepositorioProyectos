<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeacherController extends Controller
{
    public function index(Request $request): Response
    {
        $teachers = Teacher::where('role=teacher', $role=teacher)->get();
    }

    public function show(Request $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);
    }

    public function update(TeacherUpdateRequest $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);

        $user->update($request->validated());
    }

    public function destroy(Request $request, Teacher $teacher): Response
    {
        $teacher = Teacher::find($id);

        $user->delete();
    }
}
