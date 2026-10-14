<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index()
{
    $clientes = Cliente::all();

    return view('clientes.index', compact('clientes'));
}
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.editar', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clientes', 'correo')->ignore($cliente->id),
            ],
            'telefono' => ['required', 'string', 'max:30'],
            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id',
            ],
        ]);

        $cliente->update($datos);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}

