<?php

session_start();

// Si ya existe una sesión activa, dirigir al usuario al panel.
if (isset($_SESSION['usuario_id'])) {
    header('Location: panel.php');
    exit;
}

$error = $_GET['error'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión | PymeGest</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            box-sizing: border-box;
            background-color: #f4f7fb;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 36px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .login-logo {
            display: block;
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin: 0 auto 12px;
        }

        .login-card h1 {
            margin: 0 0 8px;
            text-align: center;
            color: #172554;
            font-size: 2rem;
        }

        .login-subtitulo {
            margin: 0 0 28px;
            text-align: center;
            color: #64748b;
        }

        .login-form-group {
            margin-bottom: 18px;
        }

        .login-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 700;
        }

        .login-form-group input {
            width: 100%;
            min-height: 46px;
            padding: 11px 13px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background: #ffffff;
            color: #1f2937;
            font: inherit;
            outline: none;
            transition: 0.2s ease;
        }

        .login-form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .login-submit {
            width: 100%;
            min-height: 46px;
            padding: 11px 16px;
            border: 0;
            border-radius: 9px;
            background: #2563eb;
            color: #ffffff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .login-submit:hover {
            background: #1d4ed8;
        }

        .login-error {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #fecdd3;
            border-radius: 9px;
            background: #fff1f2;
            color: #9f1239;
            text-align: center;
        }

        .login-volver {
            display: block;
            margin-top: 22px;
            text-align: center;
            color: #475569;
            font-weight: 600;
            text-decoration: none;
        }

        .login-volver:hover {
            color: #1d4ed8;
        }
    </style>
</head>

<body>

    <main class="login-page">

        <section class="login-card">

            <img
                src="img/logo-pymegest.jpeg"
                alt="Logo de PymeGest"
                class="login-logo"
            >

            <h1>PymeGest</h1>

            <p class="login-subtitulo">
                Inicia sesión para continuar
            </p>

            <?php if ($error !== ''): ?>
                <div class="login-error" role="alert">
                    Correo o contraseña incorrectos.
                </div>
            <?php endif; ?>

            <form action="autenticar.php" method="POST">

                <div class="login-form-group">

                    <label for="correo">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        autocomplete="email"
                        required
                    >

                </div>

                <div class="login-form-group">

                    <label for="contrasena">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        id="contrasena"
                        name="contrasena"
                        autocomplete="current-password"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="login-submit"
                >
                    Iniciar sesión
                </button>

            </form>

            <a href="index.html" class="login-volver">
                ← Volver al inicio
            </a>

        </section>

    </main>

</body>

</html>