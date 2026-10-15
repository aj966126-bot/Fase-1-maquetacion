
@extends('layouts.app')

@section('titulo', 'Clientes')

@section('contenido')

    {{-- Encabezado del módulo de clientes --}}
    <section class="app-encabezado-pagina">
        <div>
            <span class="app-etiqueta">Gestión comercial</span>
            <h1>Clientes registrados</h1>
            <p>
                Consulta y administra los clientes asociados
                a las empresas de PymeGest.
            </p>
        </div>

        <a href="{{ route('clientes.create') }}"
           class="app-boton app-boton-primario">
            + Nuevo cliente
        </a>
    </section>

    {{-- Mensajes de confirmación --}}
    @if (session('exito'))
        <div class="app-alerta app-alerta-exito" role="status">
            {{ session('exito') }}
        </div>
    @endif

    {{-- Listado de clientes --}}
    <section class="app-tarjeta">

        @if ($clientes->isEmpty())

            <div class="app-vacio">
                <h2>No hay clientes registrados</h2>
                <p>
                    Registra el primer cliente para comenzar
                    a gestionar la información comercial.
                </p>

                <a href="{{ route('clientes.create') }}"
                   class="app-boton app-boton-primario">
                    Registrar cliente
                </a>
            </div>

        @else

            <div class="app-tabla-contenedor">
                <table class="app-tabla">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Empresa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->correo }}</td>
                                <td>{{ $cliente->telefono }}</td>

                                <td>
                                    {{ $cliente->empresa?->nombre ?? 'Sin empresa' }}
                                </td>

                                <td>
                                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">

                                        {{-- Editar cliente --}}
                                        <a href="{{ route('clientes.edit', $cliente->id) }}"
                                           class="app-boton app-boton-secundario">
                                            Editar
                                        </a>

                                        {{-- Eliminar cliente --}}
                                        <form
                                            action="{{ route('clientes.destroy', $cliente->id) }}"
                                            method="POST"
                                            style="margin: 0;"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="app-boton"
                                                style="background-color: #c62828; color: #ffffff; cursor: pointer;"
                                            >
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @endif

    </section>

@endsection