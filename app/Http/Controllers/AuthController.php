<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validación: Usamos 'Phone' y 'Password' como en el SQL
        $credentials = $request->validate([
            'Phone' => ['required', 'string'],
            'Password' => ['required'],
        ]);

        // 2. Intento de autenticación
        // Nota: Auth::attempt espera un array donde la clave de la contraseña sea 'password'
        // internamente para compararla, pero gracias al método getAuthPassword() en el modelo,
        // buscará en la columna correcta.
        // Dentro de AuthController.php, en el método login:
        if (Auth::attempt(['Phone' => $credentials['Phone'], 'password' => $credentials['Password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }

        // 3. Error si falla
        return back()->withErrors([
            'Phone' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('Phone');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
