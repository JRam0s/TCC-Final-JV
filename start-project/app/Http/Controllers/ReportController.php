<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Console\Charts\Chart;
use App\Models\Categoria; // Importar o modelo Categoria

class ReportController extends Controller
{
    public function showPizza(GastoController $gastoController)
    {
        // Obter os dados de gastos categorizados
        $dadosGastos = $gastoController->getGastosPorCategoria();
        
        // Separar os dados em nomes de categorias e valores de gastos
        $nomesCategorias = array_keys($dadosGastos);
        $valoresGastos = array_values($dadosGastos);

        // Configurar as cores para maior diferenciação
        $cores = ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#F4D03F', '#8E44AD', '#1ABC9C', '#E67E22', '#3498DB', '#2ECC71'];

        // Criar o gráfico do tipo pizza
        $chart = (new LarapexChart)
            ->setType('pie') // Tipo do gráfico
            ->setLabels($nomesCategorias) // Labels das categorias
            ->setDataset($valoresGastos) // Dados dos gastos
            ->setColors($cores); // Configuração de cores

        return view('reports.chart', compact('chart'));
    }

    public function showPizzaFP(GastoController $gastoController)
{
    // Obter os dados de gastos agrupados por formas de pagamento
    $dadosGastos = $gastoController->getGastosPorFormaPagamento();
    
    // Separar os dados em nomes das formas de pagamento e valores de gastos
    $nomesFormasPagamento = array_keys($dadosGastos);
    $valoresGastos = array_values($dadosGastos);

    // Configurar as cores para maior diferenciação
    $cores = ['#F39C12', '#16A085', '#C0392B', '#8E44AD', '#27AE60', '#2980B9', '#E74C3C', '#2C3E50', '#BDC3C7', '#D35400'];

    // Criar o gráfico do tipo pizza
    $chart = (new LarapexChart)
        ->setType('pie') // Tipo do gráfico
        ->setLabels($nomesFormasPagamento) // Labels das formas de pagamento
        ->setDataset($valoresGastos) // Dados dos gastos
        ->setColors($cores); // Configuração de cores

    return view('reports.fpag', compact('chart'));
}

public function showGraficos(GastoController $gastoController)
{
    // Obter dados de gastos por categoria
    $dadosGastosCategoria = $gastoController->getGastosPorCategoria();
    $nomesCategorias = array_keys($dadosGastosCategoria);
    $valoresGastosCategoria = array_values($dadosGastosCategoria);

    // Configurar gráfico de categoria
    $chart = (new LarapexChart)
        ->setType('pie')
        ->setLabels($nomesCategorias)
        ->setDataset($valoresGastosCategoria)
        ->setColors(['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#F4D03F', '#8E44AD', '#1ABC9C', '#E67E22', '#3498DB', '#2ECC71']);

    // Obter dados de gastos por forma de pagamento
    $dadosGastosFormaPagamento = $gastoController->getGastosPorFormaPagamento();
    $nomesFormasPagamento = array_keys($dadosGastosFormaPagamento);
    $valoresGastosFormaPagamento = array_values($dadosGastosFormaPagamento);

    // Configurar gráfico de forma de pagamento
    $chart2 = (new LarapexChart)
        ->setType('pie')
        ->setLabels($nomesFormasPagamento)
        ->setDataset($valoresGastosFormaPagamento)
        ->setColors(['#F39C12', '#16A085', '#C0392B', '#8E44AD', '#27AE60', '#2980B9', '#E74C3C', '#2C3E50', '#BDC3C7', '#D35400']);


    // Retornar a view com ambos os gráficos
    return view('index', compact('chart', 'chart2'));
}

    
}