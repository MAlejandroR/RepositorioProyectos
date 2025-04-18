<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StudentController
 */
final class StudentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $students = Student::factory()->count(3)->create();

        $response = $this->get(route('students.index'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.show', $student));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StudentController::class,
            'update',
            \App\Http\Requests\StudentControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $student = Student::factory()->create();

        $response = $this->put(route('students.update', $student));

        $student->refresh();
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $student = Student::factory()->create();
        $student = User::factory()->create();

        $response = $this->delete(route('students.destroy', $student));

        $this->assertModelMissing($student);
    }
}
