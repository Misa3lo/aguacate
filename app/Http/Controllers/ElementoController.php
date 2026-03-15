<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element; // Cambiado de Elemento a Element

class ElementoController extends Controller
{
    public function index()
    {
        $elementos = Element::all();
        return view('elementos.index', compact('elementos'));
    }

    public function create()
    {
        return view('elementos.create');
    }

    public function store(Request $request)
    {
        // Validación con nombres de campos en inglés y tabla correcta
        $request->validate([
            'Name' => 'required|string|max:255|unique:elements,Name',
            'Unit' => 'required|string|max:50',
        ]);

        Element::create([
            'Name' => $request->Name,
            'Unit' => $request->Unit,
        ]);

        return redirect()->route('elementos.index')->with('success', 'Nutriente creado exitosamente.');
    }

    public function edit($id)
    {
        $elemento = Element::findOrFail($id);
        return view('elementos.edit', compact('elemento'));
    }

    public function update(Request $request, $id)
    {
        $elemento = Element::findOrFail($id);

        $request->validate([
            'Name' => 'required|string|max:255|unique:elements,Name,' . $id . ',Id',
            'Unit' => 'required|string|max:50',
        ]);

        $elemento->update([
            'Name' => $request->Name,
            'Unit' => $request->Unit,
        ]);

        return redirect()->route('elementos.index')->with('success', 'Nutriente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $elemento = Element::findOrFail($id);
        $elemento->delete();
        return redirect()->route('elementos.index')->with('success', 'Nutriente eliminado correctamente.');
    }
}
