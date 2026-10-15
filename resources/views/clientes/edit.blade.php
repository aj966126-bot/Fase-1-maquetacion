
@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('clase-main', 'app-main-formulario')

@section('contenido')

    {{-- Encabezado de la página --}}
    <section class="app-encabezado-pagina">
        <div>
            <span class="app-etiqueta">Gestión de clientes</span>
            <h1>Editar cliente</h1>
            <p>
                Actualiza la información del cliente seleccionado
                y guarda los cambios realizados.
            </p>
        </div>
    </section>

    {{-- Formulario de edición --}}
    <section class="app-tarjeta app-tarjeta-formulario">

        {{-- Mensajes de validación --}}
        @if ($errors->any())
            <div class="app-alerta app-alerta-error" role="alert">
                <strong>Revisa la información:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('clientes.update', $cliente->id) }}"
            class="app-formulario"
        >
            @csrf
            @method('PUT')

            {{-- Nombre del cliente --}}
            <div class="app-campo">
                <label for="nombre">Nombre</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $cliente->nombre) }}"
                    maxlength="100"
                    required
                >
            </div>

            {{-- Correo electrónico --}}
            <div class="app-campo">
                <label for="correo">Correo electrónico</label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo', $cliente->correo) }}"
                    maxlength="100"
                    required
                >
            </div>

            {{-- Teléfono --}}
            <div class="app-campo">
                <label for="telefono">Teléfono</label>

                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value="{{ old('telefono', $cliente->telefono) }}"
                    maxlength="20"
                    placeholder="(809) 000-0000"
                    required
                >
            </div>

            {{-- Empresa asociada --}}
            <div class="app-campo">
                <label for="empresa_id">Empresa</label>

                <select
                    id="empresa_id"
                    name="empresa_id"
                    required
                >
                    <option value="">Selecciona una empresa</option>

                    @foreach ($empresas as $empresa)
                        <option
                            value="{{ $empresa->id }}"
                            {{ old('empresa_id', $cliente->empresa_id) == $empresa->id ? 'selected' : '' }}
                        >
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Acciones del formulario --}}
            <div class="app-form-acciones">

                <button
                    type="submit"
                    class="app-boton app-boton-primario"
                    {{ $empresas->isEmpty() ? 'disabled' : '' }}
                >
                    Guardar cambios
                </button>

                <a
                    href="{{ route('clientes.index') }}"
                    class="app-boton app-boton-secundario"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </section>

@endsection