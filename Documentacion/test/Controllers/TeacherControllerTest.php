<?php

namespace Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ModelController\TeacherController
 */
final class TeacherControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $teachers = Teacher::factory()->count(3)->create();

        $response = $this->get(route('teachers.index'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teachers.show', $teacher));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ModelController\TeacherController::class,
            'update',
            \App\Http\Requests\TeacherControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $teacher = Teacher::factory()->create();
        $name = fake()->name();
        $email = fake()->safeEmail();

        $response = $this->put(route('teachers.update', $teacher), [
            'name' => $name,
            'email' => $email,
        ]);

        $teacher->refresh();

        $this->assertEquals($name, $teacher->name);
        $this->assertEquals($email, $teacher->email);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $teacher = Teacher::factory()->create();
        $teacher = User::factory()->create();

        $response = $this->delete(route('teachers.destroy', $teacher));

        $this->assertModelMissing($teacher);
    }
}
