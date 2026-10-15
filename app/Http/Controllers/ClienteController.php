<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = Cliente::with('empresa')->orderByDesc('id')->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        $empresas = Empresa::orderBy('nombre')->get();

        return view('clientes.create', compact('empresas'));
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        Cliente::create($request->validated());

        return redirect()
            ->route('clientes.index')
            ->with('exito', 'Cliente registrado correctamente.');
    }
}
