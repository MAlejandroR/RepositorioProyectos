<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cycle;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EnrollmentController
 */
final class EnrollmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $enrollments = Enrollment::factory()->count(3)->create();

        $response = $this->get(route('enrollments.index'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->get(route('enrollments.show', $enrollment));
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EnrollmentController::class,
            'store',
            \App\Http\Requests\EnrollmentControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $user = User::factory()->create();
        $cycle = Cycle::factory()->create();

        $response = $this->post(route('enrollments.store'), [
            'user_id' => $user->id,
            'cycle_id' => $cycle->id,
        ]);

        $enrollments = Enrollment::query()
            ->where('user_id', $user->id)
            ->where('cycle_id', $cycle->id)
            ->get();
        $this->assertCount(1, $enrollments);
        $enrollment = $enrollments->first();
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $enrollment = Enrollment::factory()->create();

        $response = $this->delete(route('enrollments.destroy', $enrollment));

        $this->assertModelMissing($enrollment);
    }
}
