<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$errores = [];

$valores = [
    'nombre' => '',
    'correo' => '',
    'telefono' => '',
    'empresa_id' => ''
];

$empresas = [];

try {
    $pdo = getConnection();

    $stmtEmpresas = $pdo->query(
        "SELECT id, nombre FROM empresas ORDER BY nombre"
    );

    $empresas = $stmtEmpresas->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valores['nombre'] = trim($_POST['nombre'] ?? '');
        $valores['correo'] = trim($_POST['correo'] ?? '');
        $valores['telefono'] = trim($_POST['telefono'] ?? '');
        $valores['empresa_id'] = trim($_POST['empresa_id'] ?? '');

        if ($valores['nombre'] === '') {
            $errores[] = 'El nombre es obligatorio.';
        }

        if ($valores['correo'] === '') {
            $errores[] = 'El correo es obligatorio.';
        } elseif (!filter_var($valores['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El correo no tiene un formato válido.';
        }

        if ($valores['telefono'] === '') {
            $errores[] = 'El teléfono es obligatorio.';
        }

        if (
            $valores['empresa_id'] === '' ||
            !ctype_digit((string) $valores['empresa_id'])
        ) {
            $errores[] = 'Debes seleccionar una empresa.';
        }

        if (empty($errores)) {
            $stmt = $pdo->prepare(
                "INSERT INTO clientes (nombre, correo, telefono, empresa_id)
                 VALUES (:nombre, :correo, :telefono, :empresa_id)"
            );

            $stmt->execute([
                ':nombre' => $valores['nombre'],
                ':correo' => $valores['correo'],
                ':telefono' => $valores['telefono'],
                ':empresa_id' => (int) $valores['empresa_id']
            ]);

            header('Location: index.php?creado=1');
            exit;
        }
    }
} catch (Throwable $e) {
    error_log('Error al crear cliente: ' . $e->getMessage());
    $errores[] = 'Ocurrió un error al conectar o guardar el cliente. Intenta de nuevo.';
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

    <title>Nuevo cliente | PymeGest</title>

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


<main class="app-main app-main-formulario">

    <section class="app-encabezado-pagina">

        <div>

            <span class="app-etiqueta">
                Gestión de clientes
            </span>

            <h1>
                Registrar nuevo cliente
            </h1>

            <p>
                Completa los datos para asociar un nuevo cliente
                a una empresa registrada.
            </p>

        </div>

    </section>


    <section class="app-tarjeta app-tarjeta-formulario">

        <?php if (!empty($errores)): ?>

            <div
                class="app-alerta app-alerta-error"
                role="alert"
            >

                <strong>
                    Revisa la información:
                </strong>

                <ul>

                    <?php foreach ($errores as $error): ?>

                        <li>
                            <?= e($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <?php if (empty($empresas)): ?>

            <div
                class="app-alerta app-alerta-error"
                role="alert"
            >
                No hay empresas registradas. Debe existir al menos
                una empresa antes de crear un cliente.
            </div>

        <?php endif; ?>


        <form
            method="post"
            action="crear.php"
            class="app-formulario"
        >

            <div class="app-campo">

                <label for="nombre">
                    Nombre
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="<?= e($valores['nombre']) ?>"
                    required
                >

            </div>


            <div class="app-campo">

                <label for="correo">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="<?= e($valores['correo']) ?>"
                    required
                >

            </div>


            <div class="app-campo">

                <label for="telefono">
                    Teléfono
                </label>

                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value="<?= e($valores['telefono']) ?>"
                    placeholder="(809) 000-0000"
                    required
                >

            </div>


            <div class="app-campo">

                <label for="empresa_id">
                    Empresa
                </label>

                <select
                    id="empresa_id"
                    name="empresa_id"
                    required
                >

                    <option value="">
                        Selecciona una empresa
                    </option>

                    <?php foreach ($empresas as $empresa): ?>

                        <option
                            value="<?= (int) $empresa['id'] ?>"
                            <?= (string) $valores['empresa_id'] === (string) $empresa['id']
                                ? 'selected'
                                : '' ?>
                        >
                            <?= e($empresa['nombre']) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="app-form-acciones">

                <button
                    type="submit"
                    class="app-boton app-boton-primario"
                    <?= empty($empresas) ? 'disabled' : '' ?>
                >
                    Guardar cliente
                </button>

                <a
                    href="index.php"
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