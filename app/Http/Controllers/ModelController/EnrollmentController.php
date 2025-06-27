<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnrollmentController extends Controller
{
    public function index(Request $request): Response
    {
        $enrollments = Enrollment::all();
    }

    public function show(Request $request, Enrollment $enrollment): Response
    {
        $enrollment = Enrollment::find($id);
    }

    public function store(EnrollmentStoreRequest $request): Response
    {
        $enrollment = Enrollment::create($request->validated());
    }

    public function destroy(Request $request, Enrollment $enrollment): Response
    {
        $enrollment = Enrollment::find($id);

        $enrollment->delete();
    }
}
