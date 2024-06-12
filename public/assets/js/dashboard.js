$(document).ready(function() {

    // Configurando o ajaxSetup para incluir o CSRF token em todas as requisições
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   

    var options = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#reportsChart"), options);
    chart.render();
    
    $.ajax({
        url: '/api/dashboard', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {

            console.log(response.data)
            data = response.data;

            var chart2 = new ApexCharts(document.querySelector("#budgetChart"), {
                series: data[0],
                chart: {
                    type: 'polarArea',
                    height: 350,
                    toolbar: {
                    show: true
                    }
                },
                labels: data[1],
                stroke: {
                    colors: ['#fff']
                },
                fill: {
                    opacity: 0.8
                }
            }).render();


            // chart.updateSeries([{
            //     name: 'Net Profit',
            //     data: response.net_profit
            // }, {
            //     name: 'Revenue',
            //     data: response.revenue
            // }, {
            //     name: 'Free Cash Flow',
            //     data: response.free_cash_flow
            // }]);

            // chart.updateOptions({
            //     xaxis: {
            //         categories: response.categories
            //     }
            // });
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            $('#response').html('<div class="alert alert-danger">Erro - ' + errorMessage + '</div>');
        }
    });

   

});