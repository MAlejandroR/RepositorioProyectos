<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cycle;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\UserCycle;

class EnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'cycle_id' => Cycle::factory(),
            'user_cycle_id' => UserCycle::factory(),
            "year" => $this->faker->year(),
        ];
    }
}
