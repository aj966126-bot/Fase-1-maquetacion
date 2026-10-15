@extends('layouts.app')

@section('titulo', 'Nueva solicitud')

@section('contenido')

<section class="container" style="max-width: 1050px; margin: 50px auto; padding: 0 20px;">

    <div style="margin-bottom: 30px;">
        <span style="color: #2563eb; font-weight: 700; font-size: 14px;">
            GESTIÓN EMPRESARIAL
        </span>

        <h1 style="color: #172554; font-size: 38px; margin: 15px 0;">
            Nueva solicitud
        </h1>

        <p style="color: #64748b; font-size: 17px;">
            Completa el formulario para solicitar información sobre nuestros servicios.
        </p>
    </div>

    <div style="background: #fff; padding: 35px; border-radius: 14px; box-shadow: 0 8px 30px rgba(0,0,0,.06);">

        @if(session('success'))
            <div role="status" style="padding: 15px; margin-bottom: 25px; background: #dcfce7; color: #166534; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div role="alert" style="padding: 15px; margin-bottom: 25px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
                <strong>Revisa los siguientes campos:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px;">

                <div>
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre"
                           value="{{ old('nombre') }}" maxlength="100" required
                           style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div>
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo"
                           value="{{ old('correo') }}" maxlength="100" required
                           style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div>
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono"
                           value="{{ old('telefono') }}"
                           placeholder="8095551234"
                           pattern="(809|829|849)[0-9]{7}"
                           maxlength="10" required
                           style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div>
                    <label for="empresa">Nombre de la empresa</label>
                    <input type="text" id="empresa" name="empresa"
                           value="{{ old('empresa') }}" maxlength="120" required
                           style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div>
                    <label for="sector">Sector empresarial</label>
                    <input type="text" id="sector" name="sector"
                           value="{{ old('sector') }}" maxlength="50" required
                           style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
                </div>

                <div>
                    <label for="tamano">Tamaño de la empresa</label>
                    <select id="tamano" name="tamano" required
                            style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px; background: white;">
                        <option value="">Selecciona una opción</option>
                        <option value="Microempresa" {{ old('tamano') == 'Microempresa' ? 'selected' : '' }}>Microempresa</option>
                        <option value="Pequeña" {{ old('tamano') == 'Pequeña' ? 'selected' : '' }}>Pequeña</option>
                        <option value="Mediana" {{ old('tamano') == 'Mediana' ? 'selected' : '' }}>Mediana</option>
                        <option value="Grande" {{ old('tamano') == 'Grande' ? 'selected' : '' }}>Grande</option>
                    </select>
                </div>

            </div>

            <div style="margin-top: 22px;">
                <label for="mensaje">Mensaje adicional (opcional)</label>
                <textarea id="mensaje" name="mensaje" rows="5"
                          style="width: 100%; padding: 13px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">{{ old('mensaje') }}</textarea>
            </div>

            <div style="margin-top: 28px;">
                <button type="submit"
                        style="background: #2563eb; color: white; padding: 14px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer;">
                    Enviar solicitud
                </button>
            </div>

        </form>

    </div>

</section>

@endsection