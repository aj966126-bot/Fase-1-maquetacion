<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('titulo') | PymeGest</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="app-body">

<header class="app-header">
    <div class="app-header-contenido">

        <a href="{{ url('/') }}" class="app-marca">
            <img src="{{ asset('img/logo-pymegest.jpeg') }}" alt="Logo de PymeGest">
            <span>PymeGest</span>
        </a>

        <nav class="app-nav" aria-label="Navegación interna">
            <a href="{{ url('/') }}">Inicio</a>

            <a href="{{ route('clientes.index') }}"
               class="{{ request()->routeIs('clientes.*') ? 'activo' : '' }}">
                Clientes
            </a>

        </nav>

    </div>
</header>

<main class="app-main @yield('clase-main')">
    @yield('contenido')
</main>

</body>

</html>
