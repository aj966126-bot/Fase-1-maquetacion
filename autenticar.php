<?php

session_start();

require_once __DIR__ . '/config/database.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$correo = trim($_POST['correo'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if ($correo === '' || $contrasena === '') {
    header('Location: login.php?error=1');
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: login.php?error=1');
    exit;
}

try {
    $pdo = getConnection();

    $stmt = $pdo->prepare(
        'SELECT id, nombre, correo, contrasena
         FROM usuarios
         WHERE correo = :correo
         LIMIT 1'
    );

    $stmt->execute([
        ':correo' => $correo
    ]);

    $usuario = $stmt->fetch();


    if (
        !$usuario ||
        !password_verify($contrasena, $usuario['contrasena'])
    ) {
        header('Location: login.php?error=1');
        exit;
    }

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = (int) $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    $_SESSION['usuario_correo'] = $usuario['correo'];

    header('Location: panel.php');
    exit;

} catch (Throwable $e) {
    error_log('Error de autenticación: ' . $e->getMessage());

    header('Location: login.php?error=1');
    exit;
}