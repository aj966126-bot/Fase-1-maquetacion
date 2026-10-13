@extends('layouts.app')

@section('titulo', 'Nuevo cliente')

@section('clase-main', 'app-main-formulario')

@section('contenido')

    <section class="app-encabezado-pagina">
        <div>
            <span class="app-etiqueta">Gestión de clientes</span>
            <h1>Registrar nuevo cliente</h1>
            <p>Completa los datos para asociar un nuevo cliente a una empresa registrada.</p>
        </div>
    </section>

    <section class="app-tarjeta app-tarjeta-formulario">

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

        @if ($empresas->isEmpty())
            <div class="app-alerta app-alerta-error" role="alert">
                No hay empresas registradas. Debe existir al menos una empresa antes de crear un cliente.
            </div>
        @endif

        <form method="post" action="{{ route('clientes.store') }}" class="app-formulario">
            @csrf

            <div class="app-campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="app-campo">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            </div>

            <div class="app-campo">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                       placeholder="(809) 000-0000" required>
            </div>

            <div class="app-campo">
                <label for="empresa_id">Empresa</label>
                <select id="empresa_id" name="empresa_id" required>
                    <option value="">Selecciona una empresa</option>

                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}"
                            {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="app-form-acciones">
                <button type="submit" class="app-boton app-boton-primario"
                        {{ $empresas->isEmpty() ? 'disabled' : '' }}>
                    Guardar cliente
                </button>

                <a href="{{ route('clientes.index') }}" class="app-boton app-boton-secundario">
                    Cancelar
                </a>
            </div>

        </form>

    </section>

@endsection
