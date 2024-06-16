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
            data: []
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
            categories: [],
        },
        yaxis: {
            min: 0, // valor mínimo do eixo y
            max: 4.0, // valor máximo do eixo y
            tickAmount: 8,
            title: {
                text: 'Médias da Avaliação (Soma das notas ÷ Qtd. de Perguntas)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    if(val <= 2.5) {
                        return  val + "Necessita desenvolver"
                    } else if(val > 2.5 && val <= 3.5) {
                        return  val + "Atende aos requisitos"
                    } else if(val > 3.5 && val <= 4.0) {
                        return  val + "Supera/ É Referência "
                    }
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#reportsChart"), options);
    chart.render();
    
    let userId = $('#userId').val()
    $.ajax({
        url: `/api/dashboard/${userId}`, 
        type: 'GET',
        dataType: 'json',
        success: function(response) {

            console.log(response)
            data = response.data;
            evaluationData = response.evaluationData;

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
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            $('#response').html('<div class="alert alert-danger">Erro - ' + errorMessage + '</div>');
        }
    });

   

});