<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::orderBy('id', 'desc')->get();
        return view('admin.solicitudes', compact('solicitudes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:100'],
            'telefono' => ['required', 'regex:/^(809|829|849)[0-9]{7}$/'],
            'empresa' => ['required', 'string', 'max:120'],
            'sector' => ['required', 'string', 'max:50'],
            'tamano' => ['required', 'string', 'max:30'],
            'mensaje' => ['nullable', 'string'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'telefono.regex' => 'El teléfono debe ser un número válido de República Dominicana (809, 829 o 849) de 10 dígitos.',
        ]);

        Solicitud::create($validated);

        return back()->with('success', '¡Solicitud guardada con éxito en la base de datos!');
    }
}