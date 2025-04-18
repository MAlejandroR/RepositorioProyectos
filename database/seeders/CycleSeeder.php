<?php

namespace Database\Seeders;

use App\Models\Cycle;
use Illuminate\Database\Seeder;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Informática y comunicaciones' => [
                'CFGS Administración de Sistemas Informáticos en Red',
                'CFGS Desarrollo de Aplicaciones Multiplataforma',
                'CFGS Desarrollo de Aplicaciones Web',
            ],
            'Comercio y marketing' => [
                'CFGS Comercio Internacional',
                'CFGS Gestión de Ventas y Espacios Comerciales',
                'CFGS Transporte y Logística',
                'CFGS Marketing y Publicidad',
            ],
            'Imagen y sonido' => [
                'CFGS Animaciones 3d, Juegos y Entornos Interactivos',
                'CFGS Iluminación, Captación y Tratamiento de la Imagen',
                'CFGS Producción de Audiovisuales y Espectáculos',
                'CFGS Realización de Proyectos de Audiovisuales y Espectáculos',
            ],
        ];

        foreach ($data as $family => $cycles) {
            foreach ($cycles as $cycle) {
                Cycle::create([
                    'name' => $cycle,
                    'family' => $family,
                ]);
            }
        }
    }
}
