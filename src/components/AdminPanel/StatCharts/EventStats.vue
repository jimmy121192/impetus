<template>
  <div id="eventStats">
    <div id="content">
      <canvas ref="chart"></canvas>
    </div>
  </div>
</template>

<script>
  import Chart from 'chart.js'
  import store from '@/store.js'

  export default {
    name: 'EventStats',
    data() {
      return {

      }
    },
    mounted() {

      var chart = this.$refs.chart;
      var ctx = chart.getContext("2d");
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {

          labels: ["Event 1", "Event 2", "Event 3", "Event 4", "Event 5", "Event 6"],
          datasets: [{
            label: '# of Attendees',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
              'rgba(23, 162, 184, 0.6)',
              'rgba(23, 162, 184, 0.6)',
              'rgba(23, 162, 184, 0.6)',
              'rgba(23, 162, 184, 0.6)',
              'rgba(23, 162, 184, 0.6)',
              'rgba(23, 162, 184, 0.6)'
            ],
            borderColor: [
              'rgba(23, 162, 184, 1)',
              'rgba(23, 162, 184, 1)',
              'rgba(23, 162, 184, 1)',
              'rgba(23, 162, 184, 1)',
              'rgba(23, 162, 184, 1)',
              'rgba(23, 162, 184, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    }
  }

</script>

<style>
  #eventStats {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #000;
    margin-top: 60px;
  }

  #content {
    background-color: #FFFFFF;
  }

</style>
