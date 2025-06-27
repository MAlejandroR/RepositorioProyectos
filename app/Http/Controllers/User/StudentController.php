<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render("Dashboard/Student/Index");
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
