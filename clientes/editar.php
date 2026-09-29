<?php

require_once __DIR__ . '/../config/database.php';

$errores = [];

$id = $_GET['id'] ?? '';

if ($id === '' || !ctype_digit((string) $id)) {
    die('Cliente no válido.');
}

$valores = [
    'nombre' => '',
    'correo' => '',
    'telefono' => '',
    'empresa_id' => ''
];

$empresas = [];

try {

    $pdo = getConnection();

    // Obtener empresas para el selector
    $stmtEmpresas = $pdo->query(
        "SELECT id, nombre FROM empresas ORDER BY nombre"
    );

    $empresas = $stmtEmpresas->fetchAll(PDO::FETCH_ASSOC);

    // Buscar el cliente
    $stmtCliente = $pdo->prepare(
        "SELECT id, nombre, correo, telefono, empresa_id
         FROM clientes
         WHERE id = :id"
    );

    $stmtCliente->execute([
        ':id' => (int) $id
    ]);

    $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        die('El cliente no existe.');
    }

    // Mostrar los datos actuales
    $valores['nombre'] = $cliente['nombre'];
    $valores['correo'] = $cliente['correo'];
    $valores['telefono'] = $cliente['telefono'];
    $valores['empresa_id'] = $cliente['empresa_id'];

    // Cuando se presiona Guardar cambios
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $valores['nombre'] = trim($_POST['nombre'] ?? '');
        $valores['correo'] = trim($_POST['correo'] ?? '');
        $valores['telefono'] = trim($_POST['telefono'] ?? '');
        $valores['empresa_id'] = trim($_POST['empresa_id'] ?? '');

        // Validaciones
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

        // Actualizar cliente
        if (empty($errores)) {

            $stmt = $pdo->prepare(
                "UPDATE clientes
                 SET nombre = :nombre,
                     correo = :correo,
                     telefono = :telefono,
                     empresa_id = :empresa_id
                 WHERE id = :id"
            );

            $stmt->execute([
                ':nombre' => $valores['nombre'],
                ':correo' => $valores['correo'],
                ':telefono' => $valores['telefono'],
                ':empresa_id' => (int) $valores['empresa_id'],
                ':id' => (int) $id
            ]);

            header('Location: index.php?actualizado=1');
            exit;
        }
    }

} catch (Throwable $e) {

    error_log('Error al editar cliente: ' . $e->getMessage());

    $errores[] = 'Ocurrió un error al actualizar el cliente. Intenta de nuevo.';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>PymeGest - Editar cliente</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="page-container">

    <h1>Editar cliente</h1>

    <?php if (!empty($errores)): ?>

        <ul class="alert alert-error">

            <?php foreach ($errores as $err): ?>

                <li>
                    <?php echo htmlspecialchars($err); ?>
                </li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>


    <form
        method="POST"
        action="editar.php?id=<?php echo (int) $id; ?>"
        class="form-cliente"
    >

        <label for="nombre">Nombre</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?php echo htmlspecialchars($valores['nombre']); ?>"
            required
        >


        <label for="correo">Correo</label>

        <input
            type="email"
            id="correo"
            name="correo"
            value="<?php echo htmlspecialchars($valores['correo']); ?>"
            required
        >


        <label for="telefono">Teléfono</label>

        <input
            type="text"
            id="telefono"
            name="telefono"
            value="<?php echo htmlspecialchars($valores['telefono']); ?>"
            required
        >


        <label for="empresa_id">Empresa</label>

        <select
            id="empresa_id"
            name="empresa_id"
            required
        >

            <option value="">
                -- Selecciona una empresa --
            </option>

            <?php foreach ($empresas as $empresa): ?>

                <option
                    value="<?php echo htmlspecialchars($empresa['id']); ?>"
                    <?php
                    echo (
                        (string) $valores['empresa_id'] ===
                        (string) $empresa['id']
                    ) ? 'selected' : '';
                    ?>
                >

                    <?php echo htmlspecialchars($empresa['nombre']); ?>

                </option>

            <?php endforeach; ?>

        </select>


        <button
            type="submit"
            class="btn btn-primary"
        >
            Guardar cambios
        </button>


        <a
            href="index.php"
            class="btn btn-outline"
        >
            Cancelar
        </a>

    </form>

</div>

</body>

</html>