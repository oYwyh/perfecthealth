<template>
    <aside>
      <Line
        class="active"
        id="chart"
        :options="chartOptions"
        :data="chartData"
      />
    </aside>
  </template>

  <script>
  import { Line } from 'vue-chartjs';
  import { Chart as ChartJS, CategoryScale, BarElement, ArcElement, LinearScale, PointElement, LineElement, Title, Tooltip, Legend } from 'chart.js';

  ChartJS.register(CategoryScale, LinearScale, PointElement, BarElement, ArcElement, LineElement, Title, Tooltip, Legend);
export default {
    props: ['label', 'labels', 'datas'],
    name: 'LineCharts',
    components: { Line },
    data() {
      return {
        chartData: {
          labels: this.labels.split(','),
          datasets: [
            {
              label: this.label,
              data: this.datas.split(','),
              pointBackgroundColor: 'white',
              borderWidth: 1,
              fill: true,
              backgroundColor: (context) => {
                const bgColor = [
                    'rgba(255,26,104,0.2)',
                    'rgba(54,162,235,0.2)',
                    'rgba(255,206,86,0.2)',
                    'rgba(75,192,192,0.2)',
                    'rgba(153,102,255,0.2)',
                    'rgba(255,159,64,0.2)',
                    'rgba(0,0,0,0.2)',
                ];
                if(!context.chart.chartArea) {
                    return;
                }
                const {ctx,data,chartArea: {top,bottom}} = context.chart;
                const gradientBg = ctx.createLinearGradient(0,top,0,bottom);
                gradientBg.addColorStop(0,bgColor[0])
                gradientBg.addColorStop(0.5,bgColor[1])
                gradientBg.addColorStop(1,bgColor[2])
                return gradientBg;
              },
              pointBorderColor: 'gray',
              tension: 0.2,
            },
          ],
        },
        chartOptions: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              labels: {
                font: {
                  size: 14,
                },
                usePointStyle: true,
                pointStyle: 'rectRounded',
              },
            },
          },
        },
      };
    },

  };
  </script>
