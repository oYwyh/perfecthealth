<script setup></script>
<template>
<aside>
    <Doughnut
        class="active"
        id="my-chart-id"
        ref="chart"
        :options="chartOptions"
        :data="chartData"
    />
</aside>
</template>
<script>
import { Doughnut } from 'vue-chartjs'
import { Pie } from 'vue-chartjs'
import { Bar } from 'vue-chartjs'
import { Line } from 'vue-chartjs'

import ChartJSPluginDatalabels from 'chartjs-plugin-datalabels';

import {
Chart as ChartJS,
Title,
Tooltip,
Legend,
LineElement,
CategoryScale,
LinearScale,
PointElement,
Filler,
} from 'chart.js'

ChartJS.register(ChartJSPluginDatalabels,Title, Tooltip, Legend, LineElement, LinearScale, CategoryScale, PointElement, Filler)

export default {
name: 'PieChart',
components: { Doughnut },
props: ['gender'],
data() {
    let genderData = this.gender.split(',').map(Number);
    return {
        chartData: {
            labels: ['male','female'],
            datasets: [
                {
                    label: 'Total',
                    pointBackgroundColor: 'white',
                    borderWidth: 1,
                    fill: true,
                    pointBorderColor: 'blue',
                    backgroundColor: ['#194bfb','#42f082'],
                    data: genderData,
                    tension: 0.5,
                    // backgroundColor:
                }
            ]
        },
        chartOptions: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        font: {
                            size: 16
                        },
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                    }
                },
                datalabels: {
                    display: true,
                    font: {
                        size: 18,
                        weight:'bold'
                    },
                    color: 'white',
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value*100 / sum).toFixed(0)+"%";
                        return percentage;
                    }
                }
            }
        }
    }
},

mounted() {

}
}
</script>
