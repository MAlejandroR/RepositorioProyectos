<?php

namespace App\Filament\Resources\CycleResource\Widgets;

use App\Models\Family;
use App\Models\Cycle;

use Filament\Widgets\ChartWidget;

class CiclesCharPie extends ChartWidget
{
//    protected ?string $heading = 'Ciclos por familia';
//    protected static ?string $description = 'Ciclos formativos por familia profesional';
    protected static ?string $icon = 'heroicon-o-user-plus';
    /*
     *  Stat::make(__('Ciclos'), Cycle::count())
                    ->description(__('Ciclos formativos'))
                    ->color('success')
                    ->icon('heroicon-o-user-plus')
                    ->url(route('_filament.admin.resources.users.index'))  // ⬅️ Aquí el enlace
                    ->extraAttributes(['class' => 'cursor-pointer']),
     * */
    public function getHeading(): string
    {
        return Cycle::count() ." ". __("Ciclos Formativos");


    }

    protected function getType(): string
    {
        return 'bar'; // Horizontal bar chart
    }

    protected function getData(): array
    {
        $families = \App\Models\Family::withCount('cycles')
            ->having('cycles_count', '>', 0)
            ->get();

        $labels = $families->pluck('name')->toArray();

        $data = $families->pluck('cycles_count')->toArray();
        $colors = $families->pluck('color')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => __("Ciclos Formativos"),
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => $colors,
                    'borderWidth' => 1,
                    // 🔽 Opcional: más margen si los textos son grandes
                    'barThickness' => 25,
                ]
            ],
        ];
    }

    protected function getOptions(): ?array
    {
        return [
            'indexAxis' => 'y', // barras horizontales
            'plugins' => [
                'legend' => ['display' => true],
                'tooltip' => ['enabled' => true],
                // ACTIVA datalabels:
                'datalabels' => [
                    'enabled' => true,
                    'anchor' => 'start',     // posición dentro de la barra
                    'align' => 'start',      // alineado a la izquierda
                    'color' => '#fff',       // color del texto
                    'font' => [
                        'weight' => 'bold',
                        'size' => 14
                    ],
                    'formatter' => fn($value) => "Ciclos por familia"
                ],
            ],
            'scales' => [
                'x' => ['beginAtZero' => true, 'ticks' => ['precision' => 0]],
            ]
        ];
    }


}
