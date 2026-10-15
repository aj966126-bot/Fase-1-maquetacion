<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Formulario de inicio de sesión
    |--------------------------------------------------------------------------
    */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Autenticación del usuario
    |--------------------------------------------------------------------------
    | Valida las credenciales contra la tabla usuarios.
    */
    public function login(Request $request): RedirectResponse
    {
        $credenciales = $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required', 'string'],
        ]);

        if (!Auth::attempt([
            'correo' => $credenciales['correo'],
            'password' => $credenciales['contrasena'],
        ])) {
            throw ValidationException::withMessages([
                'correo' => 'El correo electrónico o la contraseña son incorrectos.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('clientes.index'));
    }

    /*
    |--------------------------------------------------------------------------
    | Cierre de sesión
    |--------------------------------------------------------------------------
    | Finaliza la sesión y regenera el token CSRF.
    */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}