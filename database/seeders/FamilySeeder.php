<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;


class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = config ("families");


        foreach ($families as $family=>$data) {

            $familiy_create=Family::create([
                    "name"=>$family,
                    "color"=>$data['color'],
                    "departament_name"=>$data['departamento']
                    ]
            );

            if (is_array($data['especialidades']) && count($data['especialidades'])>0){
                foreach ($data['especialidades'] as $especialidad) {
                    Specialization::create([
                        "name"=>$especialidad,
                        "family_id"=>$familiy_create->id,
                    ]);
                }

            }else
                Specialization::create(
                    ["name"=>$family,
                      "family_id" => $familiy_create->id  ]
                );

        }
    }
}

