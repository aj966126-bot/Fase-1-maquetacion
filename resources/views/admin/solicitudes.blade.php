@extends('layouts.app')

@section('titulo', 'Solicitudes recibidas')

@section('contenido')

<section style="max-width: 1450px; margin: 50px auto; padding: 0 25px;">

    <!-- Encabezado del módulo -->
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">

        <div>
            <span style="color: #2563eb; font-size: 14px; font-weight: 700;">
                GESTIÓN EMPRESARIAL
            </span>

            <h1 style="font-size: 38px; color: #172554; margin: 15px 0;">
                Solicitudes recibidas
            </h1>

            <p style="color: #64748b; font-size: 17px;">
                Consulta las solicitudes empresariales registradas en PymeGest.
            </p>
        </div>

        <a href="{{ route('solicitudes.create') }}"
           style="background: #2563eb; color: white; padding: 14px 22px; border-radius: 8px; text-decoration: none; font-weight: 700;">
            + Nueva solicitud
        </a>

    </div>

    <!-- Resumen de solicitudes -->
    <div style="background: white; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 5px 20px rgba(0,0,0,.05);">

        <p style="color: #64748b; margin: 0 0 10px;">
            Total de solicitudes registradas
        </p>

        <strong style="font-size: 32px; color: #172554;">
            {{ $solicitudes->count() }}
        </strong>

    </div>

    <!-- Listado administrativo -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,.05); overflow-x: auto;">

        <table style="width: 100%; border-collapse: collapse; text-align: left;">

            <thead style="background: #f1f5f9; color: #334155;">
                <tr>
                    <th style="padding: 18px;">ID</th>
                    <th style="padding: 18px;">Nombre</th>
                    <th style="padding: 18px;">Correo</th>
                    <th style="padding: 18px;">Teléfono</th>
                    <th style="padding: 18px;">Empresa</th>
                    <th style="padding: 18px;">Sector</th>
                    <th style="padding: 18px;">Tamaño</th>
                    <th style="padding: 18px;">Fecha</th>
                </tr>
            </thead>

            <tbody>

                @forelse($solicitudes as $solicitud)

                    <tr style="border-top: 1px solid #e2e8f0;">

                        <td style="padding: 18px;">
                            {{ $solicitud->id }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->nombre }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->correo }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->telefono }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->empresa }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->sector }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->tamano }}
                        </td>

                        <td style="padding: 18px;">
                            {{ $solicitud->fecha_registro
                                ? \Illuminate\Support\Carbon::parse($solicitud->fecha_registro)->format('d/m/Y H:i')
                                : 'No disponible' }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" style="padding: 55px; text-align: center; color: #64748b;">
                            No hay solicitudes registradas todavía.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection