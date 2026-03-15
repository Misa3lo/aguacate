<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plot;
use App\Models\PlotElement;

class InicioController extends Controller
{
    public function index()
    {
        // Consulta ajustada estrictamente a tu archivo SQL
        $stats = DB::table('element_analysis')
            ->join('plot_elements', 'element_analysis.plot_element_id', '=', 'plot_elements.Id')
            ->join('elements', 'plot_elements.Element_id', '=', 'elements.Id')
            ->select('elements.Name', DB::raw('AVG(element_analysis.ind_kenworthy) as promedio'))
            ->groupBy('elements.Name')
            ->get();

        // Verificamos si hay datos en la consola de Laravel (opcional para debug)
        // \Log::info($stats);

        return view('inicio', [
            'nombresElementos' => $stats->pluck('Name'),
            'valoresKenworthy' => $stats->pluck('promedio'),
            'totalHuertos' => \App\Models\Plot::count(),
            'ultimaMuestra' => \App\Models\PlotElement::latest('Id')->first()
        ]);
    }
}
