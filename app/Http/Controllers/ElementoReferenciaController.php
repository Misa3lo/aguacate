<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElementoReferencia;
use App\Models\Elemento; // Necesario para obtener el catálogo de elementos

class ElementoReferenciaController extends Controller
{
    public function index()
    {
        // Cargamos la relación con Elemento para mostrar el nombre del nutriente
        $referencias = ElementoReferencia::with('elemento')->get();
        return view('elementos_referencia.index', compact('referencias'));
    }

    public function create()
    {
        $elementos = Elemento::all(); // Lista de elementos para el select
        return view('elementos_referencia.create', compact('elementos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'elemento_id' => 'required|exists:elemento,id|unique:elemento_referencia,elemento_id', // Solo una referencia por elemento
            'valor_referencia' => 'required|numeric|min:0',
            'coef_variacion' => 'required|numeric|min:0',
        ]);

        ElementoReferencia::create($request->all());
        return redirect()->route('referencias.index')->with('success', 'Referencia creada exitosamente.');
    }

    public function edit(ElementoReferencia $elementoReferencia) // Usamos el nombre del modelo
    {
        $elementos = Elemento::all();
        return view('elementos_referencia.edit', compact('elementoReferencia', 'elementos'));
    }

    public function update(Request $request, ElementoReferencia $elementoReferencia)
    {
        $request->validate([
            // unique, ignorando el ID actual
            'elemento_id' => 'required|exists:elemento,id|unique:elemento_referencia,elemento_id,' . $elementoReferencia->id,
            'valor_referencia' => 'required|numeric|min:0',
            'coef_variacion' => 'required|numeric|min:0',
        ]);

        $elementoReferencia->update($request->all());
        return redirect()->route('referencias.index')->with('success', 'Referencia actualizada exitosamente.');
    }

    public function destroy(ElementoReferencia $elementoReferencia)
    {
        $elementoReferencia->delete();
        return redirect()->route('referencias.index')->with('success', 'Referencia eliminada correctamente.');
    }
}
