<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | PymeGest</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
            color: #1e293b;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            margin: 20px;
            padding: 35px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 8px;
            color: #1d4ed8;
            text-align: center;
        }

        .subtitle {
            margin-bottom: 30px;
            text-align: center;
            color: #64748b;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 14px;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <main class="login-container">

        <h1>PymeGest</h1>
        <p class="subtitle">Sistema de Gestión Empresarial</p>

        @if ($errors->any())
            <div class="error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

            <label for="correo">Correo electrónico</label>
            <input
                type="email"
                id="correo"
                name="correo"
                value="{{ old('correo') }}"
                placeholder="ejemplo@correo.com"
                autocomplete="username"
                required
            >

            <label for="contrasena">Contraseña</label>
            <input
                type="password"
                id="contrasena"
                name="contrasena"
                placeholder="Introduce tu contraseña"
                autocomplete="current-password"
                required
            >

            <button type="submit">Iniciar sesión</button>
        </form>

        <p class="footer">
            © {{ date('Y') }} PymeGest. Todos los derechos reservados.
        </p>

    </main>
</body>
</html>