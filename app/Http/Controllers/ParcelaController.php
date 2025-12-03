<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use App\Models\Usuario; // Necesario para la lista de dueños

class ParcelaController extends Controller
{
    /**
     * Muestra la lista de todas las parcelas.
     */
    public function index()
    {
        // Obtener todas las parcelas, cargando la relación con el usuario (dueño)
        $parcelas = Parcela::with('usuario')->get();

        return view('parcelas.index', compact('parcelas'));
    }

    /**
     * Muestra el formulario para crear una nueva parcela.
     */
    public function create()
    {
        // Necesitamos la lista de usuarios para el <select> en el formulario
        $usuarios = Usuario::all();

        return view('parcelas.create', compact('usuarios'));
    }

    /**
     * Almacena una nueva parcela en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'usuario_id' => 'required|exists:usuario,id', // Debe existir un usuario con ese ID
            'coordenada_gps' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'extension_ha' => 'required|numeric|min:0',
            'num_arboles' => 'nullable|integer|min:0',
        ]);

        // 2. Creación del registro
        Parcela::create($request->all());

        // 3. Redirección y mensaje
        return redirect()->route('parcelas.index')->with('success', 'Parcela registrada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una parcela específica.
     */
    public function edit(Parcela $parcela)
    {
        // Necesitamos la lista de usuarios para el <select>
        $usuarios = Usuario::all();

        return view('parcelas.edit', compact('parcela', 'usuarios'));
    }

    /**
     * Actualiza la parcela especificada en la base de datos.
     */
    public function update(Request $request, Parcela $parcela)
    {
        // 1. Validación de los datos
        $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'coordenada_gps' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'extension_ha' => 'required|numeric|min:0',
            'num_arboles' => 'nullable|integer|min:0',
        ]);

        // 2. Actualización del registro
        $parcela->update($request->all());

        // 3. Redirección y mensaje
        return redirect()->route('parcelas.index')->with('success', 'Parcela actualizada exitosamente.');
    }

    /**
     * Elimina la parcela especificada.
     */
    public function destroy(Parcela $parcela)
    {
        $parcela->delete();
        return redirect()->route('parcelas.index')->with('success', 'Parcela eliminada correctamente.');
    }
}
