<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Cycle;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class StudentsPieWidget extends ChartWidget
{
    protected  ?string $heading = 'Estudiantes por ciclo';

    protected function getData(): array
    {
// Get all cycles with family and users (only students)
        //students are user with student role
        $cycles = Cycle::with(['family', 'students.roles'])
            ->get();

        $labels = [];
        $values = [];
        $colors = [];

        foreach ($cycles as $cycle) {
// Filter users with role 'student'
            $studentCount = $cycle->students->filter(function ($user) {
                return $user->hasRole('student');
            })->count();

            $labels[] = $cycle->name;
            $values[] = $studentCount;
            $colors[] = $cycle->family?->color ?? '#cccccc';
//            $this->cycleUrls[] = route('_filament.admin.resources.teachers.index', ['family_id' => $family->id]);

        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Estudiantes',
                    'data' => $values,
                    'backgroundColor' => $colors,
                    'borderColor' => $colors,
                    'borderWidth' => 1,
                    // 🔽 Opcional: más margen si los textos son grandes
                    'barPercentage' => 1.0,       // hasta 1.0 para que ocupe todo
                    'categoryPercentage' => 1.0,  // idem
                    'barThickness' => 50,         // opcional: controla grosor de cada barra

                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // or 'pie' if you prefer
    }

    public function getColumns(): int|string|array
    {
        return ['md' => 6];
    }
    protected function getOptions(): RawJs|array
    {
//        info($this->familyUrls);
//        $urls = json_encode($this->familyUrls);
//        info($urls);
//        $urls = json_encode($this->familyUrls, JSON_UNESCAPED_SLASHES);
//        $urls = str_replace('"', "'", json_encode($this->familyUrls, JSON_UNESCAPED_SLASHES));


        return RawJs::make(<<<JS
{
    indexAxis: 'y', // barras horizontales
    plugins: {
        legend: { display: false },
        tooltip: { enabled: true },
        datalabels: {
            enabled: true,
            anchor: 'start',
            align: 'start',
            color: '#fff',

            font: {
                weight: 'bold',
                size: 14
            },
            formatter: function(value, context) {
                var label = context.chart.data.labels[context.dataIndex];
                return value + ' de ' + label;
            }
        }
    },
    scales: {
        x: {
            beginAtZero: true,
            ticks: {
                precision: 20,
                stepSize: 5
            }
        },
        y: {
            ticks: {
                display: false,
                precision: 20,

            }
        }
    },

     onHover: function(event, elements) { //Complicado para mí, cogido del chat, para que aparezca el cursor pointer
        const canvas = event.native.target;
        if (elements.length) {
            canvas.style.cursor = 'pointer';
        } else {
            canvas.style.cursor = 'default';
        }
    },
    onClick: function (evt, elements) {
        if (elements.length > 0) {
            // var index = elements[0].index;
            // var url = this.options.familyUrls[index];
            // if (url) {
            //     window.location.href = url;
            // }
        }
    }
}
JS
        );
    }
}
