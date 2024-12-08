@extends('template.main', ['menu' => "", 'submenu' => "HOME"])

@section('titulo') Gráficos de Gastos @endsection

@section('conteudo')

<div class="row">
    <!-- Primeiro Gráfico: Gastos por Categoria -->
    <div class="col-md-6">
        <h3 class="text-primary">Gastos por Categoria</h3>
        <!-- Link do ApexCharts -->
        <link href="https://cdn.jsdelivr.net/npm/apexcharts" rel="stylesheet">

        <!-- Renderização do gráfico de categoria -->
        <div id="chart-container-category">
            {!! $chart->container() !!}
        </div>

        <!-- Scripts necessários -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        {!! $chart->script() !!}

        <!-- Customizações adicionais para o gráfico de categoria -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartId = "{!! $chart->id !!}";
                const options = {
                    chart: {
                        type: 'pie',
                        toolbar: {
                            show: true
                        }
                    },
                    legend: {
                        position: 'right',
                        markers: {
                            shape: 'circle'
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return 'R$ ' + val.toLocaleString('pt-BR');
                            }
                        }
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: true
                        }
                    }
                };
                const chartElement = document.querySelector(`#${chartId}`);
                if (chartElement) {
                    const chart = ApexCharts.getChartById(chartId);
                    if (chart) {
                        chart.updateOptions(options);
                    }
                }
            });
        </script>
    </div>

    <!-- Segundo Gráfico: Gastos por Forma de Pagamento -->
    <div class="col-md-6">
        <h3 class="text-primary">Gastos por Forma de Pagamento</h3>
        <!-- Link do ApexCharts -->
        <link href="https://cdn.jsdelivr.net/npm/apexcharts" rel="stylesheet">

        <!-- Renderização do gráfico de forma de pagamento -->
        <div id="chart-container-payment">
            {!! $chart2->container() !!}
        </div>

        <!-- Scripts necessários -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        {!! $chart2->script() !!}

        <!-- Customizações adicionais para o gráfico de forma de pagamento -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartId = "{!! $chart2->id !!}";
                const options = {
                    chart: {
                        type: 'pie',
                        toolbar: {
                            show: true
                        }
                    },
                    legend: {
                        position: 'right',
                        markers: {
                            shape: 'circle'
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return 'R$ ' + val.toLocaleString('pt-BR');
                            }
                        }
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: true
                        }
                    }
                };
                const chartElement = document.querySelector(`#${chartId}`);
                if (chartElement) {
                    const chart = ApexCharts.getChartById(chartId);
                    if (chart) {
                        chart.updateOptions(options);
                    }
                }
            });
        </script>
    </div>
</div>

@endsection
