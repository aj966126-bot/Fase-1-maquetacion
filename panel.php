<?php

session_start();

if (
    !isset(
        $_SESSION['usuario_id'],
        $_SESSION['usuario_nombre'],
        $_SESSION['usuario_correo']
    )
) {
    header('Location: login.php');
    exit;
}

function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel | PymeGest</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body class="app-body">

<header class="app-header">

    <div class="app-header-contenido">

        <a href="panel.php" class="app-marca">
            <img
                src="img/logo-pymegest.jpeg"
                alt="Logo de PymeGest"
            >
            <span>PymeGest</span>
        </a>

        <nav class="app-nav" aria-label="Navegación interna">

            <a href="index.html">
                Inicio
            </a>

            <a href="panel.php" class="activo">
                Panel
            </a>

            <a href="clientes/index.php">
                Clientes
            </a>

            <a href="solicitudes/index.php">
                Solicitudes
            </a>

            <a href="logout.php" class="app-salir">
                Cerrar sesión
            </a>

        </nav>

    </div>

</header>


<main class="app-main">

    <section class="app-encabezado-pagina">

        <div>

            <span class="app-etiqueta">
                Panel administrativo
            </span>

            <h1>
                ¡Bienvenido a PymeGest!
            </h1>

            <p>
                Administra la información de clientes y consulta
                las solicitudes recibidas desde el formulario.
            </p>

        </div>

    </section>


    <section class="app-tarjeta app-tarjeta-formulario">

        <div class="panel-dashboard">

            <div class="dashboard-header">

                <div>
                    Información de la sesión
                </div>

                <span class="estado">
                    Sesión activa
                </span>

            </div>


            <div class="dashboard-card">

                <span>
                    Usuario
                </span>

                <strong>
                    <?= e($_SESSION['usuario_nombre']) ?>
                </strong>

            </div>


            <div class="dashboard-card">

                <span>
                    Correo electrónico
                </span>

                <strong>
                    <?= e($_SESSION['usuario_correo']) ?>
                </strong>

            </div>


            <div class="app-form-acciones">

                <a
                    href="clientes/index.php"
                    class="app-boton app-boton-primario"
                >
                    Gestionar clientes
                </a>

                <a
                    href="solicitudes/index.php"
                    class="app-boton app-boton-secundario"
                >
                    Ver solicitudes
                </a>

                <a
                    href="logout.php"
                    class="app-boton app-boton-peligro"
                >
                    Cerrar sesión
                </a>

            </div>

        </div>

    </section>

</main>

</body>

</html>