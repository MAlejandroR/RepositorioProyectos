<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index(Request $request): Response
    {
        $students = Student::where('role=student', $role=student)->get();
    }

    public function show(Request $request, Student $student): Response
    {
        $student = Student::find($id);
    }

    public function update(StudentUpdateRequest $request, Student $student): Response
    {
        $student = Student::find($id);

        $user->update($request->validated());
    }

    public function destroy(Request $request, Student $student): Response
    {
        $student = Student::find($id);

        $user->delete();
    }
}
