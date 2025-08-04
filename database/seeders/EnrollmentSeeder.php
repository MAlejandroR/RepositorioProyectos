<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Seeder;


class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnos = User::role("student")->get()->each(function(User $alumno){
/*
 *        $table->foreignId('user_id')->constrained();
            $table->foreignId('cycle_id')->constrained();
            $table->foreignId('user_cycle_id');
*/

           Enrollment::create([
                "user_id"=>$alumno->id,
                "cycle_id"=>"",
                ""=>""
            ]);

        });
        $alumnos = $alumnos->toArray();

    }
}
