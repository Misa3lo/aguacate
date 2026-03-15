<?php

namespace App\Http\Controllers;

use App\Models\RecomendationApplication;
use Illuminate\Http\Request;

class RecomendacionAplicacionController extends Controller
{
    /**
     * Muestra la lista de todas las recomendaciones generadas.
     */
    public function index()
    {
        // Cargamos las relaciones para mostrar información completa en la tabla
        // Recomendación -> Análisis -> Muestreo -> Elemento/Parcela
        $recomendaciones = RecomendationApplication::with([
            'elementAnalysis.plotElement.element',
            'elementAnalysis.plotElement.plot'
        ])->get();

        return view('recomendaciones_aplicacion.index', compact('recomendaciones'));
    }

    /**
     * Muestra el detalle de una recomendación específica.
     */
    public function show($id)
    {
        $recomendacion = RecomendationApplication::with([
            'elementAnalysis.plotElement.element'
        ])->findOrFail($id);

        return view('recomendaciones_aplicacion.show', compact('recomendacion'));
    }

    // Nota: Los métodos de creación usualmente se disparan automáticamente
    // mediante un Service o el Observer del AnalisisElemento.
}
