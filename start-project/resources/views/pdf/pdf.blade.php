<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório PDF</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        line-height: 1.6;
        color: #333;
    }

    h1 {
        color: #444;
        text-align: center;
        margin-bottom: 20px;
    }

    h2 {
        color: #555;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th {
        background-color: #f4f4f4;
        color: #333;
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
    }

    td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .highlight {
        font-weight: bold;
        color: #007bff;
    }

    .category-title {
        color: #007bff;
        font-weight: bold;
        margin: 20px 0 5px;
    }

    .totals {
        margin: 0;
        font-weight: bold;
        color: #333;
    }
    </style>
</head>

<body>
    <h1>Relatório de Gastos, Ganhos, Metas, Pagamentos e Categorias</h1>

    <section>
        <h2>Gastos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Forma de Pagamento</th>
                    <th>Vencimento</th>
                    <th>Data de Pagamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gasto as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->categoria->nome ?? 'Categoria não encontrada' }}</td>
                    <td class="highlight">R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                    <td>{{ $item->pagamento->nome ?? 'Pagamento não encontrado' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->dt_vencimento)->format('d/m/Y') }}</td>
                    <td>
                        @if($item->dt_pagamento)
                        {{ \Carbon\Carbon::parse($item->dt_pagamento)->format('d/m/Y') }}
                        @else
                        &nbsp;
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Ganhos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Fixo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ganho as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->categoria->nome ?? 'Categoria não encontrada' }}</td>
                    <td class="highlight">R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                    <td>{{ $item->fixo ? 'Sim' : 'Não' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Metas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Alcançado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meta as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->alcancado ? 'Sim' : 'Não' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Pagamentos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagamento as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->descricao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Ganhos e Gastos Por Categoria</h2>
        <table class="totals-table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Total de Ganhos</th>
                    <th>Total de Gastos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoria as $item)
                    @php
                    $ganho = $item->ganhos->first(); // Obtem o primeiro registro agregado
                    $gasto = $item->gastos->first(); // Obtem o primeiro registro agregado
                    @endphp
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td class="highlight">R$ {{ $ganho ? number_format($ganho->total_ganhos, 2, ',', '.') : 'R$ 0,00' }}
                        </td>
                        <td class="highlight">R$ {{ $gasto ? number_format($gasto->total_gastos, 2, ',', '.') : 'R$ 0,00' }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>
</body>

</html>