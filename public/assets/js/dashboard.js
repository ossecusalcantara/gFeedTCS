$(document).ready(function() {

    // Configurando o ajaxSetup para incluir o CSRF token em todas as requisições
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   

    var options = {
        series: [{
            name: '',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
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
            min: 0, // valor mínimo do eixo y
            max: 4.0, // valor máximo do eixo y
            tickAmount: 8,
            title: {
                text: 'Médias da Avaliação (Soma das notas ÷ ÷ Qtd. de Perguntas)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    if(val <= 2.5) {
                        return  val + " - Necessita desenvolver"
                    } else if(val > 2.5 && val <= 3.5) {
                        return  val + " - Atende aos requisitos"
                    } else if(val > 3.5 && val <= 4.0) {
                        return  val + " - Supera/ É Referência "
                    }
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

            data = response.data;
            console.log(response)
            evaluationData = response.evaluationData;
            dataActivity = response.dataActivity;

            $('#countFeedbackYear').text(response.countFeedbackYear);
            $('#countFeedbackMounth').text(response.countFeedbackMouth);

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

            chart.updateSeries([{
                name: 'Média',
                data: evaluationData[0]
            }]);

            chart.updateOptions({
                xaxis: {
                    categories: evaluationData[1]
                }
            });

           
            var chart3 =  new ApexCharts(document.querySelector("#activityChart"), {
                series: dataActivity['values'],
                chart: {
                    height: 350,
                    type: 'donut',
                    toolbar: {
                        show: true
                    }
                },
                labels: dataActivity['labels'],
            }).render();
            
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            $('#response').html('<div class="alert alert-danger">Erro - ' + errorMessage + '</div>');
        }
    });

   

});