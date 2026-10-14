<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | PymeGest</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #334155;
        }

        /* Encabezado y navegación */
        .app-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px #00000008;
        }

        .app-header-contenido {
            max-width: 1200px;
            margin: auto;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .app-marca {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1d3557;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }

        .app-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .app-nav a {
            padding: 10px 14px;
            color: #334155;
            font-size: 14px;
            text-decoration: none;
            border-radius: 6px;
        }

        .app-nav a:hover,
        .app-nav a.activo {
            background: #e8eef6;
            color: #1d3557;
        }

        /* Contenido principal */
        .app-main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .app-encabezado-pagina {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .app-etiqueta {
            display: inline-block;
            margin-bottom: 10px;
            color: #2878b5;
            font-size: 13px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 10px;
            color: #1d3557;
            font-size: 30px;
        }

        .app-encabezado-pagina p {
            margin: 0;
            color: #64748b;
            line-height: 1.5;
        }

        /* Tarjeta y tabla */
        .app-tarjeta {
            padding: 25px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 5px 20px #0000000a;
        }

        .app-tabla-contenedor {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .app-tabla {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        .app-tabla th,
        .app-tabla td {
            padding: 15px 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .app-tabla th {
            background: #1d3557;
            color: #ffffff;
            font-size: 13px;
            white-space: nowrap;
        }

        .app-tabla tbody tr:hover {
            background: #f8fafc;
        }

        .app-tabla tbody tr:last-child td {
            border-bottom: none;
        }

        /* Botones */
        .app-boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
            min-height: 42px;
            padding: 11px 16px;
            border: none;
            border-radius: 7px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .app-boton-primario {
            background: #1d3557;
            color: #ffffff;
        }

        .app-boton-primario:hover {
            background: #284b78;
        }

        .app-boton-secundario {
            background: #2878b5;
            color: #ffffff;
        }

        .app-boton-secundario:hover {
            background: #1d6094;
        }

        .app-boton-peligro {
            background: #c62828;
            color: #ffffff;
        }

        .app-boton-peligro:hover {
            background: #a51d1d;
        }

        .app-boton-pequeno {
            width: 90px;
            min-width: 90px;
            height: 36px;
            min-height: 36px;
            padding: 8px;
            font-size: 13px;
        }

        .app-acciones {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .app-form-inline {
            margin: 0;
            padding: 0;
        }

        /* Mensajes */
        .app-alerta {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
        }

        .app-alerta-exito {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .app-alerta-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .app-vacio {
            padding: 35px 15px;
            text-align: center;
        }

        .app-vacio h2 {
            color: #1d3557;
        }

        .app-vacio p {
            margin-bottom: 22px;
            color: #64748b;
        }

        @media (max-width: 700px) {
            .app-header-contenido,
            .app-encabezado-pagina {
                align-items: flex-start;
                flex-direction: column;
            }

            .app-main {
                margin: 25px auto;
                padding: 0 12px;
            }

            .app-tarjeta {
                padding: 15px;
            }

            h1 {
                font-size: 25px;
            }

            .app-acciones {
                gap: 6px;
            }
        }
    </style>
</head>

<body>

<header class="app-header">
    <div class="app-header-contenido">

        <a href="{{ route('clientes.index') }}" class="app-marca">
            PymeGest
        </a>

        <nav class="app-nav" aria-label="Navegación interna">
            <a href="{{ route('clientes.index') }}">Inicio</a>
            <a href="{{ route('clientes.index') }}" class="activo">Clientes</a>
        </nav>

    </div>
</header>

<main class="app-main">

    <section class="app-encabezado-pagina">
        <div>
            <span class="app-etiqueta">Gestión comercial</span>
            <h1>Clientes registrados</h1>
            <p>
                Consulta y administra los clientes asociados
                a las empresas de PymeGest.
            </p>
        </div>
    </section>

    @if (session('success'))
        <div class="app-alerta app-alerta-exito" role="status">
            {{ session('success') }}
        </div>
    @endif

    <section class="app-tarjeta">

        @forelse ($clientes as $cliente)

            @if ($loop->first)
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
            @endif

                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->correo }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->empresa_id }}</td>
                                <td>
                                    <div class="app-acciones">
                                        <a
                                            href="{{ route('clientes.edit', $cliente->id) }}"
                                            class="app-boton app-boton-secundario app-boton-pequeno"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('clientes.destroy', $cliente->id) }}"
                                            method="POST"
                                            class="app-form-inline"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="app-boton app-boton-peligro app-boton-pequeno"
                                            >
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

            @if ($loop->last)
                        </tbody>
                    </table>
                </div>
            @endif

        @empty
            <div class="app-vacio">
                <h2>No hay clientes registrados</h2>
                <p>Los clientes aparecerán aquí cuando estén registrados.</p>
            </div>
        @endforelse

    </section>

</main>

</body>
</html>
