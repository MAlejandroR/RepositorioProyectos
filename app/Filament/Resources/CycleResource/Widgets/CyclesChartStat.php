<?php

namespace App\Filament\Resources\CycleResource\Widgets;

use Filament\Widgets\ChartWidget;

class CyclesChartStat extends ChartWidget
{
//    protected ?string $heading = 'Listado de ciclos';

//    protected string $view = 'filament.resources.cycle-resource.widgets.cycles-chart-stat';

    protected int | string | array $columnSpan = 'full'; // or '1/2', adjust as needed

    public function getCyclesCount(): int
    {
        return \App\Models\Cycle::count();

    }
    public function getChartData(): array
    {
        $families = \App\Models\Family::withCount('cycles')
            ->having('cycles_count', '>', 0)
            ->get();

        return [
            'labels' => $families->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => __("Ciclos Formativos"),
                    'data' => $families->pluck('cycles_count')->toArray(),
                    'backgroundColor' => $families->pluck('color')->toArray(),
                ]
            ],
        ];
    }
    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}
