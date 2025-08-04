<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\AlumnosFactory;
use App\Models\Cycle;

class AlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Ciclos del cpi fp los enlaces
        //Apaño para pruebas
        //TODO por config o generalizarlo solo ciclos de un determinado centro ???
        $cycles = config("cycles_enlaces");
        $name_cyles = collect($cycles)->flatMap(fn($cicles) => collect($cicles)->pluck(1))->values();


        AlumnosFactory::new()->count(20)->create()->each(function ($alumno) use ($name_cyles) {
            $alumno->assignRole("student");
            $cycle_enrollments = $name_cyles->random();
            $id_cycle = Cycle::where("name", $cycle_enrollments)->first()->id;
            Enrollment::create(
                [  "user_id" => $alumno->id,
                   "cycle_id" => $id_cycle
                ]);
        });

    }
}
