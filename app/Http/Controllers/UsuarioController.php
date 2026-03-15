<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPlot; // Cambiado de Usuario a UserPlot
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Usa el modelo correcto y la tabla users_plot
        $usuarios = UserPlot::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Phone' => 'required|string|max:15|unique:users_plot,Phone', // Referencia a tabla correcta
            'Password' => 'required|min:4'
        ]);

        UserPlot::create([
            'Name' => $request->Name,
            'Phone' => $request->Phone,
            'Password' => Hash::make($request->Password), // Uso de Hash estándar
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Dueño registrado correctamente.');
    }

    public function edit($id)
    {
        $usuario = UserPlot::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = UserPlot::findOrFail($id);

        $request->validate([
            'Name' => 'required|string|max:255',
            'Phone' => 'required|string|max:15|unique:users_plot,Phone,' . $id . ',Id', // Ignora el Id actual
            'Password' => 'nullable|string|min:4',
        ]);

        $usuario->Name = $request->Name;
        $usuario->Phone = $request->Phone;

        if ($request->filled('Password')) {
            $usuario->Password = Hash::make($request->Password);
        }

        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = UserPlot::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
