<?php

namespace App\Http\Controllers;

use App\Models\AnalisisElemento;

class AnalisisElementoController extends Controller
{
    /**
     * Muestra la lista de todos los análisis realizados.
     */
    public function index()
    {
        // Aquí podríamos cargar relaciones si las definiste en el Modelo AnalisisElemento
        $analisis = AnalisisElemento::all();
        return view('analisis_elementos.index', compact('analisis'));
    }

    // Los métodos create, store, edit, update, destroy se omiten por ser datos calculados.
}
