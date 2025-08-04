import Chart from 'chart.js/auto'
import ChartDataLabels from 'chartjs-plugin-datalabels'


Chart.register(ChartDataLabels)

window.Chart = Chart
window.ChartDataLabels = ChartDataLabels;


window.filamentChartJsPlugins ??= []
window.filamentChartJsPlugins.push(ChartDataLabels)

console.log('Plugin loaded:', Chart);
console.log('Registered plugins:', Chart.registeredPlugins);

//
// // Override default plugin options globally:
// Chart.defaults.set('plugins.datalabels', {
//     anchor: 'start',
//     align: 'start',
//     color: '#fff',
//     font: {
//         weight: 'bold',
//         size: 14,
//     },
//     formatter: function(value, context) {
//         return 'Ciclos por familia';  // custom text you want
//     },
// });
