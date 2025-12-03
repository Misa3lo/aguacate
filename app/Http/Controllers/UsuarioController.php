<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash; // Importante para encriptar la contraseña

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15|unique:usuario,telefono',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' busca un campo 'password_confirmation'
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password), // ¡Siempre encriptar!
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Único, ignorando el ID actual
            'telefono' => 'required|string|max:15|unique:usuario,telefono,' . $usuario->id,
            // El password es opcional al actualizar, pero si se envía, se valida
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->only('nombre', 'telefono');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
