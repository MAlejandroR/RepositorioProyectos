<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CycleController
 */
final class CycleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $cycles = Cycle::factory()->count(3)->create();

        $response = $this->get(route('cycles.index'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $cycle = Cycle::factory()->create();

        $response = $this->get(route('cycles.show', $cycle));
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CycleController::class,
            'store',
            \App\Http\Requests\CycleControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $family = fake()->word();

        $response = $this->post(route('cycles.store'), [
            'name' => $name,
            'family' => $family,
        ]);

        $cycles = Cycle::query()
            ->where('name', $name)
            ->where('family', $family)
            ->get();
        $this->assertCount(1, $cycles);
        $cycle = $cycles->first();
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CycleController::class,
            'update',
            \App\Http\Requests\CycleControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $cycle = Cycle::factory()->create();
        $name = fake()->name();
        $family = fake()->word();

        $response = $this->put(route('cycles.update', $cycle), [
            'name' => $name,
            'family' => $family,
        ]);

        $cycle->refresh();

        $this->assertEquals($name, $cycle->name);
        $this->assertEquals($family, $cycle->family);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $cycle = Cycle::factory()->create();

        $response = $this->delete(route('cycles.destroy', $cycle));

        $this->assertModelMissing($cycle);
    }
}
