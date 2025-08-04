<?php

namespace App\Filament\Resources\TeacherResource\Widgets;

use App\Models\Cycle;
use App\Models\Family;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;

class TeacherWidgetPie extends ChartWidget
{

    protected static ?string $heading = 'Profesores por ciclo formativo';
    protected array $familyUrls = [];

    // Por ejemplo, que ocupe la mitad (6 columnas de 12)
    // protected int|string|array $columnSpan = 6;
    public function getColumns(): int|string|array
    {
        return [
            'md' => 4,
            'xl' => 1,
        ];
    }
    //Labels son los ciclos formativos que tenga
    //Values el número de profesores de cada ciclo formativo
    protected function getData(): array
    {
        // Get families that have specializations with users (teachers)
        $families = Family::has('specializations.users')->get(['name', 'color', 'id']);

        // Labels: family names
        $labels = $families->pluck('name')->toArray();

        // Values: total teachers per family
        $values = [];
        foreach ($families as $family) {
            // Sum all users in the specializations of this family
            $count = $family->specializations()
                ->withCount('users')
                ->get()
                ->sum('users_count');
            $values[] = $count;
            $this->familyUrls[] = route('filament.admin.resources.teachers.index', ['family_id' => $family->id]);
        }

        // Colors: get colors from family
        $colors = $families->pluck('color')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Profesores',
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

    /*  protected function getOptions(): ?array
      {

          return [
              'indexAxis' => 'y', // barras horizontales
              'plugins' => [
                  'legend' => ['display' => false],
                  'tooltip' => ['enabled' => true],
                  // ACTIVA datalabels:
                  'datalabels' => [
                      'enabled' => true,
                      'anchor' => 'start',     // posición dentro de la barra
                      'align' => 'start',      // alineado a la izquierda
                      'color' => '#fff',       // color del texto
                      'font' => [
                          'weight' => 'bold',
                          'size' => 16
                      ],
                      'formatter' => fn($value) => "$value profesores por familia"
                  ],
              ],
              'scales' => [
                  'x' => ['beginAtZero' => true, 'ticks' => ['precision' => 0]],
              ]
          ];
      }*/

    protected function getOptions(): RawJs|array
    {
        info($this->familyUrls);
        $urls = json_encode($this->familyUrls);
        info($urls);
        $urls = json_encode($this->familyUrls, JSON_UNESCAPED_SLASHES);
        $urls = str_replace('"', "'", json_encode($this->familyUrls, JSON_UNESCAPED_SLASHES));


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
    familyUrls: $urls,
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
            var index = elements[0].index;
            var url = this.options.familyUrls[index];
            if (url) {
                window.location.href = url;
            }
        }
    }
}
JS
        );
    }


    protected function getType(): string
    {
        return 'bar';
    }

}
