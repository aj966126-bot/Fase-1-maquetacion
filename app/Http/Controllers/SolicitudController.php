<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Listado administrativo de solicitudes
    |--------------------------------------------------------------------------
    | Consulta las solicitudes registradas, ordenadas por ID.
    | El acceso se protegerá mediante las rutas de autenticación.
    */
    public function index(): View
    {
        $solicitudes = Solicitud::orderByDesc('id')->get();

        return view('admin.solicitudes', compact('solicitudes'));
    }

    /*
    |--------------------------------------------------------------------------
    | Formulario público de solicitudes
    |--------------------------------------------------------------------------
    | Permite solicitar información sin iniciar sesión.
    */
    public function create(): View
    {
        return view('solicitud');
    }

    /*
    |--------------------------------------------------------------------------
    | Registro de solicitudes
    |--------------------------------------------------------------------------
    | Valida la información y guarda el registro en PostgreSQL.
    */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:100'],
            'telefono' => [
                'required',
                'regex:/^(809|829|849)[0-9]{7}$/',
            ],
            'empresa' => ['required', 'string', 'max:120'],
            'sector' => ['required', 'string', 'max:50'],
            'tamano' => ['required', 'string', 'max:30'],
            'mensaje' => ['nullable', 'string'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'telefono.regex' => 'El teléfono debe tener 10 dígitos y comenzar con 809, 829 o 849.',
        ]);

        Solicitud::create($datos);

        return redirect()
            ->route('solicitudes.create')
            ->with('success', '¡Solicitud registrada correctamente!');
    }
}