<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProjectController
 */
final class ProjectControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $projects = Project::factory()->count(3)->create();

        $response = $this->get(route('projects.index'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $project = Project::factory()->create();

        $response = $this->get(route('projects.show', $project));
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'store',
            \App\Http\Requests\ProjectControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = fake()->sentence(4);
        $description = fake()->text();
        $enrollment = Enrollment::factory()->create();
        $teacher = Teacher::factory()->create();

        $response = $this->post(route('projects.store'), [
            'title' => $title,
            'description' => $description,
            'enrollment_id' => $enrollment->id,
            'teacher_id' => $teacher->id,
        ]);

        $projects = Project::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('enrollment_id', $enrollment->id)
            ->where('teacher_id', $teacher->id)
            ->get();
        $this->assertCount(1, $projects);
        $project = $projects->first();
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'update',
            \App\Http\Requests\ProjectControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $project = Project::factory()->create();
        $title = fake()->sentence(4);
        $description = fake()->text();
        $teacher = Teacher::factory()->create();

        $response = $this->put(route('projects.update', $project), [
            'title' => $title,
            'description' => $description,
            'teacher_id' => $teacher->id,
        ]);

        $project->refresh();

        $this->assertEquals($title, $project->title);
        $this->assertEquals($description, $project->description);
        $this->assertEquals($teacher->id, $project->teacher_id);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $this->assertModelMissing($project);
    }
}
