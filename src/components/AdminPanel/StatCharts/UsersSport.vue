<template>
    <div id="usersSport">
        <div id="content">
            <canvas ref="chart"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import store from '@/store.js'

    export default {
        name: 'UsersSport',
        mounted() {
            var chart = this.$refs.chart;
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  // I've been playing with VUEX, this works but I don't know how to connect to DB so I will leave it for now
                    labels: [ "Badminton", "Basketball", "Volleyball", "Soccer", "Tennis", "Table Tennis", "Esport" ],
                    datasets: [{
                        label: '# of Users',
                        data: [40, 60, 38, 49, 61, 32, 55],
                        backgroundColor: [
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)',
                            'rgba(214, 7, 7, 0.6)'
                        ],
                        borderColor: [
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)',
                            'rgba(214, 7, 7, 1)'
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
    #usersSport {
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