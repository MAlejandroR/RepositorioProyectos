<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Enrollment;
use App\Models\EnrollmentUser;
use App\Models\Project;
use App\Models\User;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'enrollment_id' => Enrollment::factory(),
            'teacher_id' => User::factory(),
            'enrollment_user_id' => EnrollmentUser::factory(),
        ];
    }
}
