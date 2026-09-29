<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$mensaje = '';

if (isset($_GET['creado']) && $_GET['creado'] === '1') {
    $mensaje = 'Cliente registrado correctamente.';
} elseif (isset($_GET['actualizado']) && $_GET['actualizado'] === '1') {
    $mensaje = 'Cliente actualizado correctamente.';
} elseif (isset($_GET['eliminado']) && $_GET['eliminado'] === '1') {
    $mensaje = 'Cliente eliminado correctamente.';
}

$clientes = [];
$error = '';

try {
    $pdo = getConnection();

    $stmt = $pdo->prepare(
        "SELECT c.id, c.nombre, c.correo, c.telefono, e.nombre AS empresa
         FROM clientes c
         JOIN empresas e ON c.empresa_id = e.id
         ORDER BY c.id DESC"
    );

    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    error_log('Error al leer clientes: ' . $e->getMessage());
    $error = 'Ocurrió un error al cargar los clientes. Intenta de nuevo más tarde.';
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

    <title>Clientes | PymeGest</title>

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
            <span>PymeGest</span>
        </a>

        <nav class="app-nav" aria-label="Navegación interna">

            <a href="../index.html">
                Inicio
            </a>

            <a href="../panel.php">
                Panel
            </a>

            <a href="index.php" class="activo">
                Clientes
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
                Gestión comercial
            </span>

            <h1>
                Clientes registrados
            </h1>

            <p>
                Consulta y administra los clientes asociados
                a las empresas de PymeGest.
            </p>

        </div>

        <a
            href="crear.php"
            class="app-boton app-boton-primario"
        >
            + Nuevo cliente
        </a>

    </section>


    <?php if ($mensaje): ?>

        <div
            class="app-alerta app-alerta-exito"
            role="status"
        >
            <?= e($mensaje) ?>
        </div>

    <?php endif; ?>


    <?php if ($error): ?>

        <div
            class="app-alerta app-alerta-error"
            role="alert"
        >
            <?= e($error) ?>
        </div>

    <?php endif; ?>


    <section class="app-tarjeta">

        <?php if (empty($clientes) && !$error): ?>

            <div class="app-vacio">

                <h2>
                    No hay clientes registrados
                </h2>

                <p>
                    Registra el primer cliente para comenzar
                    a gestionar la información comercial.
                </p>

                <a
                    href="crear.php"
                    class="app-boton app-boton-primario"
                >
                    Registrar cliente
                </a>

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
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($clientes as $cliente): ?>

                            <tr>

                                <td>
                                    <?= (int) $cliente['id'] ?>
                                </td>

                                <td>
                                    <?= e($cliente['nombre']) ?>
                                </td>

                                <td>
                                    <?= e($cliente['correo']) ?>
                                </td>

                                <td>
                                    <?= e($cliente['telefono']) ?>
                                </td>

                                <td>
                                    <?= e($cliente['empresa']) ?>
                                </td>

                                <td>

                                    <div class="app-acciones">

                                        <a
                                            href="editar.php?id=<?= (int) $cliente['id'] ?>"
                                            class="app-boton app-boton-secundario app-boton-pequeno"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="eliminar.php"
                                            method="post"
                                            class="app-form-inline"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"
                                        >

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= (int) $cliente['id'] ?>"
                                            >

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

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </section>

</main>

</body>

</html>