<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Ganho;
use App\Models\Categoria;
use App\Models\Pagamento;
use App\Models\Meta;
use PDF;

class PdfController extends Controller
{
    public function geraPdf()
    {
        $ganhosPorCategoria = Ganho::with('categoria')
    ->selectRaw('categoria_id, SUM(valor) as total_ganhos')
    ->groupBy('categoria_id')
    ->get()
    ->map(function ($ganho) {
        $ganho->categoria_nome = $ganho->categoria->nome ?? 'Categoria não encontrada';
        return $ganho;
    });

$gastosPorCategoria = Gasto::with('categoria')
    ->selectRaw('categoria_id, SUM(valor) as total_gastos')
    ->groupBy('categoria_id')
    ->get()
    ->map(function ($gasto) {
        $gasto->categoria_nome = $gasto->categoria->nome ?? 'Categoria não encontrada';
        return $gasto;
    });


        $gasto = Gasto::all();
        $ganho = Ganho::all();
        $categoria = Categoria::with([
            'ganhos' => function ($query) {
                $query->selectRaw('categoria_id, SUM(valor) as total_ganhos')->groupBy('categoria_id');
            },
            'gastos' => function ($query) {
                $query->selectRaw('categoria_id, SUM(valor) as total_gastos')->groupBy('categoria_id');
            },
        ])->get();
        
        $pagamento = Pagamento::all();
        $meta = Meta::all();

        $pdf = PDF::loadView('pdf.pdf', compact('gasto', 'ganho', 'categoria', 'pagamento', 'meta', 'gastosPorCategoria', 'ganhosPorCategoria'));

        return response($pdf->setPaper('a3')->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Relatórios de Finanças.pdf"',
        ]);
    }
}

