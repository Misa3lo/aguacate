<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElementReference; // Actualizado
use App\Models\Element; // Actualizado

class ElementoReferenciaController extends Controller
{
    public function index()
    {
        // Cargamos la relación 'element' (en inglés)
        $referencias = ElementReference::with('element')->get();
        return view('elementos_referencia.index', compact('referencias'));
    }

    public function create()
    {
        $elementos = Element::all();
        return view('elementos_referencia.create', compact('elementos'));
    }

    public function store(Request $request)
    {
        // 1. Validar usando los nombres con Mayúscula inicial
        $request->validate([
            'Element_id' => 'required|exists:elements,Id',
            'Reference_value' => 'required|numeric',
            'Deviation_coefficient' => 'required|numeric',
        ]);

        // 2. Crear el registro
        // Al usar $request->all(), Laravel buscará las llaves 'Element_id', etc.
        // que coinciden con nuestro array $fillable del modelo.
        ElementReference::create($request->all());

        return redirect()->route('referencias.index')
            ->with('success', 'Referencia guardada correctamente.');
    }

    public function edit(ElementReference $elementoReferencia)
    {
        // Cargamos todos los elementos para el select
        $elementos = Element::all();

        // Pasamos la variable a la vista.
        // OJO: Si la vista usa $referencia, debemos enviarla así:
        return view('elementos_referencia.edit', [
            'referencia' => $elementoReferencia,
            'elementos' => $elementos
        ]);
    }

    public function update(Request $request, ElementReference $elementoReferencia)
    {
        // 1. Validar usando los nombres exactos de la BD
        $request->validate([
            'Element_id' => 'required|exists:elements,Id',
            'Reference_value' => 'required|numeric',
            'Deviation_coefficient' => 'required|numeric',
        ]);

        // 2. Actualizar el modelo
        // Usamos $elementoReferencia (que es el nombre que Laravel asignó en la ruta)
        $elementoReferencia->update([
            'Element_id' => $request->Element_id,
            'Reference_value' => $request->Reference_value,
            'Deviation_coefficient' => $request->Deviation_coefficient,
        ]);

        return redirect()->route('referencias.index')
            ->with('success', 'Referencia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $elementoReferencia = ElementReference::findOrFail($id);
        $elementoReferencia->delete();
        return redirect()->route('referencias.index')->with('success', 'Referencia eliminada correctamente.');
    }
}
