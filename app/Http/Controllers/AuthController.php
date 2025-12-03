<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validación de credenciales: usamos 'telefono' como nombre de usuario
        $credentials = $request->validate([
            'telefono' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Intentar autenticar al usuario
        // Laravel usa el campo 'telefono' en lugar de 'email' automáticamente
        // si se pasa en el array de credenciales.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirigir al dashboard (ruta 'inicio')
            return redirect()->intended(route('inicio'));
        }

        // Si falla, redirigir de vuelta con un error
        return back()->withErrors([
            'telefono' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('telefono');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir a la página de inicio de sesión
        return redirect('/login');
    }
}
