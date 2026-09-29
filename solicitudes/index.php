<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$solicitudes = [];
$error = '';

try {
    $pdo = getConnection();

    $stmt = $pdo->prepare(
        "SELECT
            id,
            nombre,
            correo,
            telefono,
            empresa,
            sector,
            tamano,
            mensaje,
            fecha_registro
         FROM solicitudes
         ORDER BY fecha_registro DESC, id DESC"
    );

    $stmt->execute();

    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    error_log('Error al leer solicitudes: ' . $e->getMessage());

    $error = 'Ocurrió un error al cargar las solicitudes. Intenta de nuevo más tarde.';
}

function e(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

function formatearFecha(?string $fecha): string
{
    if (!$fecha) {
        return '';
    }

    $timestamp = strtotime($fecha);

    if ($timestamp === false) {
        return e($fecha);
    }

    return date('d/m/Y h:i A', $timestamp);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solicitudes | PymeGest</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="app-body">

<header class="app-header">

    <div class="app-header-contenido">

        <a href="../panel.php" class="app-marca">

            <img
                src="../img/logo-pymegest.jpeg"
                alt="Logo de PymeGest"
            >

            <span>
                PymeGest
            </span>

        </a>


        <nav class="app-nav" aria-label="Navegación interna">

            <a href="../index.html">
                Inicio
            </a>

            <a href="../panel.php">
                Panel
            </a>

            <a href="../clientes/index.php">
                Clientes
            </a>

            <a href="index.php" class="activo">
                Solicitudes
            </a>

            <a href="../logout.php" class="app-salir">
                Cerrar sesión
            </a>

        </nav>

    </div>

</header>


<main class="app-main">

    <section class="app-encabezado-pagina">

        <div>

            <span class="app-etiqueta">
                Solicitudes recibidas
            </span>

            <h1>
                Formularios registrados
            </h1>

            <p>
                Consulta la información enviada por los usuarios
                desde el formulario público de PymeGest.
            </p>

        </div>

    </section>


    <?php if ($error): ?>

        <div
            class="app-alerta app-alerta-error"
            role="alert"
        >
            <?= e($error) ?>
        </div>

    <?php endif; ?>


    <section class="app-tarjeta">

        <?php if (empty($solicitudes) && !$error): ?>

            <div class="app-vacio">

                <h2>
                    No hay solicitudes registradas
                </h2>

                <p>
                    Cuando un usuario complete el formulario público,
                    la información aparecerá en esta sección.
                </p>

            </div>

        <?php elseif (!$error): ?>

            <div class="app-tabla-contenedor">

                <table class="app-tabla">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Empresa</th>
                            <th>Sector</th>
                            <th>Tamaño</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($solicitudes as $solicitud): ?>

                            <tr>

                                <td>
                                    <?= (int) $solicitud['id'] ?>
                                </td>

                                <td>
                                    <?= e($solicitud['nombre']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['correo']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['telefono']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['empresa']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['sector']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['tamano']) ?>
                                </td>

                                <td>
                                    <?= e($solicitud['mensaje']) ?: 'Sin mensaje' ?>
                                </td>

                                <td>
                                    <?= formatearFecha($solicitud['fecha_registro']) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </section>

</main>

</body>

</html>