<x-filament::card>
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold">{{ __('Ciclos') }}</h2>
            <p class="text-3xl font-semibold">{{ $this->getCyclesCount() }}</p>
            <p class="text-sm text-gray-500">{{ __('Ciclos formativos') }}</p>
        </div>
        <div class="w-2/3">
            <canvas id="cycles-chart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('cycles-chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: @json($this->getChartData()),
                options: {
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: true },
                        tooltip: { enabled: true },
                        datalabels: {
                            enabled: true,
                            anchor: 'start',
                            align: 'start',
                            color: '#fff',
                            font: { weight: 'bold', size: 14 },
                            formatter: (value) => "Ciclos por familia"
                        },
                    },
                    scales: {
                        x: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        });
    </script>
</x-filament::card>
