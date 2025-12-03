<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elemento; // Importamos el Modelo

class ElementoController extends Controller
{
    /**
     * Muestra la lista de todos los elementos (nutrientes).
     */
    public function index()
    {
        // Obtener todos los elementos de la base de datos
        $elementos = Elemento::all();

        // Retorna la vista 'elementos.index' y le pasa la lista de elementos
        return view('elementos.index', compact('elementos'));
    }

    /**
     * Muestra el formulario para crear un nuevo elemento.
     */
    public function create()
    {
        // Retorna la vista 'elementos.create'
        return view('elementos.create');
    }

    /**
     * Almacena un nuevo elemento en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255|unique:elemento,nombre', // Único en la tabla 'elemento'
            'unidad' => 'required|string|max:50',
        ]);

        // 2. Creación del registro
        Elemento::create([
            'nombre' => $request->nombre,
            'unidad' => $request->unidad,
        ]);

        // 3. Redirección y mensaje
        return redirect()->route('elementos.index')->with('success', 'Elemento creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un elemento específico.
     */
    public function edit(Elemento $elemento)
    {
        // Retorna la vista 'elementos.edit' y le pasa el objeto $elemento
        return view('elementos.edit', compact('elemento'));
    }

    /**
     * Actualiza el elemento especificado en la base de datos.
     */
    public function update(Request $request, Elemento $elemento)
    {
        // 1. Validación de los datos
        $request->validate([
            // Único, pero ignorando el ID del elemento que estamos editando
            'nombre' => 'required|string|max:255|unique:elemento,nombre,' . $elemento->id,
            'unidad' => 'required|string|max:50',
        ]);

        // 2. Actualización del registro
        $elemento->update([
            'nombre' => $request->nombre,
            'unidad' => $request->unidad,
        ]);

        // 3. Redirección y mensaje
        return redirect()->route('elementos.index')->with('success', 'Elemento actualizado exitosamente.');
    }

    /**
     * Elimina el elemento especificado (Opcional, pero incluido en resource).
     */
    public function destroy(Elemento $elemento)
    {
        $elemento->delete();
        return redirect()->route('elementos.index')->with('success', 'Elemento eliminado correctamente.');
    }
}
