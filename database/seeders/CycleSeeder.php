<?php

namespace Database\Seeders;

use App\Models\Cycle;
use Illuminate\Database\Seeder;
use App\Models\Family;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cycles = config("cycles");
        foreach ($cycles as $family=>$cycleList) {

            $family=Family::where('name', $family)->first();
            foreach ($cycleList as $cycle) {
                Cycle::create([
                    "name"=>$cycle[1],
                    "code"=>$cycle[0],
                    "family_id"=>$family->id,
                ]);
            }
        }
    }
}
