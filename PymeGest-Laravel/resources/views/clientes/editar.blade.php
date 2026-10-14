
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente | PymeGest</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #334155;
        }

        /* Encabezado principal */
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

        .app-marca img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        /* Menú de navegación */
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

        .app-nav .app-salir {
            color: #c62828;
        }

        /* Contenido central */
        .app-main {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .app-encabezado-pagina {
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

        /* Tarjeta del formulario */
        .app-tarjeta {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 5px 20px #0000000a;
        }

        .app-formulario {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .app-campo {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .app-campo label {
            color: #334155;
            font-size: 14px;
            font-weight: bold;
        }

        .app-campo input,
        .app-campo select {
            width: 100%;
            min-height: 44px;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #ffffff;
            color: #334155;
            font-family: inherit;
            font-size: 14px;
        }

        .app-campo input:focus,
        .app-campo select:focus {
            outline: none;
            border-color: #2878b5;
            box-shadow: 0 0 0 3px #2878b51c;
        }

        /* Mensajes de validación */
        .app-alerta-error {
            margin-bottom: 22px;
            padding: 15px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 14px;
        }

        .app-alerta-error ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        /* Botones */
        .app-form-acciones {
            display: flex;
            gap: 12px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .app-boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
            min-height: 44px;
            padding: 12px 18px;
            border: none;
            border-radius: 7px;
            font-family: inherit;
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
            background: #e2e8f0;
            color: #334155;
        }

        .app-boton-secundario:hover {
            background: #cbd5e1;
        }

        @media (max-width: 650px) {
            .app-header-contenido {
                align-items: flex-start;
                flex-direction: column;
            }

            .app-nav {
                gap: 5px;
            }

            .app-nav a {
                padding: 9px;
            }

            .app-main {
                margin: 25px auto;
            }

            .app-tarjeta {
                padding: 20px;
            }

            .app-form-acciones {
                flex-direction: column;
            }

            .app-boton {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="app-header">
    <div class="app-header-contenido">

        <a href="{{ route('clientes.index') }}" class="app-marca">
            <span>PymeGest</span>
        </a>

        <nav class="app-nav" aria-label="Navegación interna">
            <a href="{{ route('clientes.index') }}">Clientes</a>
            <a href="{{ route('clientes.index') }}" class="activo">Editar cliente</a>
        </nav>

    </div>
</header>

<main class="app-main">

    <section class="app-encabezado-pagina">
        <span class="app-etiqueta">Gestión de clientes</span>
        <h1>Editar cliente</h1>
        <p>Actualiza la información del cliente seleccionado.</p>
    </section>

    <section class="app-tarjeta">

        @if ($errors->any())
            <div class="app-alerta-error" role="alert">
                <strong>Revisa la información:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('clientes.update', $cliente->id) }}"
            method="POST"
            class="app-formulario"
        >
            @csrf
            @method('PUT')

            <div class="app-campo">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $cliente->nombre) }}"
                    required
                >
            </div>

            <div class="app-campo">
                <label for="correo">Correo electrónico</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo', $cliente->correo) }}"
                    required
                >
            </div>

            <div class="app-campo">
                <label for="telefono">Teléfono</label>
                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value="{{ old('telefono', $cliente->telefono) }}"
                    required
                >
            </div>

            <div class="app-campo">
                <label for="empresa_id">ID de la empresa</label>
                <input
                    type="number"
                    id="empresa_id"
                    name="empresa_id"
                    value="{{ old('empresa_id', $cliente->empresa_id) }}"
                    min="1"
                    required
                >
            </div>

            <div class="app-form-acciones">
                <button type="submit" class="app-boton app-boton-primario">
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

</main>

</body>
</html>
```