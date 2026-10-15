<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Listado de clientes
    |--------------------------------------------------------------------------
    | Consulta los clientes junto con sus empresas.
    */
    public function index(): View
    {
        $clientes = Cliente::with('empresa')
            ->orderByDesc('id')
            ->get();

        return view('clientes.index', compact('clientes'));
    }

    /*
    |--------------------------------------------------------------------------
    | Formulario de registro
    |--------------------------------------------------------------------------
    | Muestra las empresas disponibles para asociar al cliente.
    */
    public function create(): View
    {
        $empresas = Empresa::orderBy('nombre')->get();

        return view('clientes.create', compact('empresas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Guardar cliente
    |--------------------------------------------------------------------------
    | Valida y registra un nuevo cliente.
    */
    public function store(StoreClienteRequest $request): RedirectResponse
    {
        Cliente::create($request->validated());

        return redirect()
            ->route('clientes.index')
            ->with('exito', 'Cliente registrado correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | Formulario de edición
    |--------------------------------------------------------------------------
    | Recupera el cliente y las empresas disponibles.
    */
    public function edit(int $id): View
    {
        $cliente = Cliente::findOrFail($id);
        $empresas = Empresa::orderBy('nombre')->get();

        return view('clientes.edit', compact('cliente', 'empresas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Actualizar cliente
    |--------------------------------------------------------------------------
    | Valida los cambios y actualiza el registro.
    */
    public function update(Request $request, int $id): RedirectResponse
    {
        $cliente = Cliente::findOrFail($id);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => [
                'required',
                'email',
                'max:100',
                Rule::unique('clientes', 'correo')->ignore($cliente->id),
            ],
            'telefono' => ['required', 'string', 'max:20'],
            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id',
            ],
        ]);

        $cliente->update($datos);

        return redirect()
            ->route('clientes.index')
            ->with('exito', 'Cliente actualizado correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | Eliminar cliente
    |--------------------------------------------------------------------------
    | Elimina el registro seleccionado.
    */
    public function destroy(int $id): RedirectResponse
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('exito', 'Cliente eliminado correctamente.');
    }
}