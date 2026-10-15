<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PymeGest | Entorno Laravel</title>
    <style>
        body { margin: 0; background: #f4f6f8; color: #1f2933; font: 1rem/1.6 Arial, sans-serif; }
        main { max-width: 760px; margin: 60px auto; padding: 32px; background: #fff; border-radius: 12px; }
        h1 { color: #004080; }
        .estado { padding: 16px; background: #d1e7dd; color: #0f5132; border-radius: 8px; }
        dt { font-weight: bold; margin-top: 16px; }
        dd { margin: 0; }
        a { color: #004080; }
    </style>
</head>
<body>
    <main>
        <h1>PymeGest — Entorno Laravel</h1>
        <p class="estado">Laravel está ejecutándose correctamente.</p>
        <p>Base de la Fase 4 preparada para integrar las vistas, migraciones y funcionalidades del equipo.</p>
        @env('local')
            <dl>
                <dt>Framework</dt>
                <dd>Laravel {{ app()->version() }}</dd>
                <dt>PHP</dt>
                <dd>{{ PHP_VERSION }}</dd>
                <dt>Conexión configurada</dt>
                <dd>{{ config('database.default') }}</dd>
                <dt>Controlador PDO PostgreSQL</dt>
                <dd>{{ extension_loaded('pdo_pgsql') ? 'Habilitado' : 'No habilitado' }}</dd>
            </dl>
            <p>Esta pantalla comprueba el arranque del framework; la conexión real a PostgreSQL se verifica después de configurar las credenciales locales.</p>
        @endenv
        <p><a href="{{ url('/up') }}">Comprobar disponibilidad del servidor</a></p>
    </main>
</body>
</html>
