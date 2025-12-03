<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionAplicacion;

class RecomendacionAplicacionController extends Controller
{
    /**
     * Muestra la lista de todas las recomendaciones.
     */
    public function index()
    {
        $recomendaciones = RecomendacionAplicacion::all();
        return view('recomendaciones_aplicacion.index', compact('recomendaciones'));
    }

    // Los métodos create, store, edit, update, destroy se omiten por ser datos calculados.
}
