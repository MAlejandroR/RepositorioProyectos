<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use const App\Http\Controllers\student;

class StudentController extends Controller
{
    public function index(Request $request): Response
    {
        $students = Student::where('role=student', $role="student")->get();
    }

    public function show(Request $request, Student $student): Response
    {
//        $student = Student::find($id);

    }

    public function update(StudentUpdateRequest $request, Student $student): Response
    {

        $student->update($request->validated());
    }

    public function destroy(Request $request, Student $student): Response
    {

        $student->delete();
    }
}
