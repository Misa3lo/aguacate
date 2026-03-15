<?php

namespace App\Http\Controllers;

use App\Models\ElementAnalysis; // Cambiado de AnalisisElemento
use Illuminate\Http\Request;

class AnalisisElementoController extends Controller
{
    /**
     * Muestra la lista de todos los análisis realizados.
     */
    public function index()
    {
        // Cargamos la relación anidada para mostrar qué nutriente se analizó
        $analisis = ElementAnalysis::with(['plotElement.element', 'plotElement.plot'])->get();

        return view('analisis_elementos.index', compact('analisis'));
    }

    /**
     * El método para generar el análisis usualmente se dispara
     * tras registrar un PlotElement (Muestreo).
     */
    public function show($id)
    {
        $analisis = ElementAnalysis::with(['plotElement.element'])->findOrFail($id);
        return view('analisis_elementos.show', compact('analisis'));
    }

    /**
     * Elimina un análisis específico.
     */
    /**
     * Elimina un análisis específico.
     */
    public function destroy($id)
    {
        // Usamos el ID con Mayúscula porque así está en tu modelo/SQL
        $analisis = \App\Models\ElementAnalysis::findOrFail($id);
        $analisis->delete();

        return redirect()->route('analisis.index')->with('success', 'Análisis eliminado correctamente.');
    }

    // Los métodos store/update suelen ser automáticos mediante la lógica de Kenworthy.
}
