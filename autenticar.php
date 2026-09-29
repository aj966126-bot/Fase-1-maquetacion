<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!file_exists('conexion.php')) {
    die("Error: El archivo conexion.php no existe en la raíz del proyecto.");
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? $_POST['email'] ?? '');

    if (empty($correo)) {
        header('Location: login.php?error=1');
        exit;
    }

    try {
        if (!isset($conexion)) {
            die("Error: La variable \$conexion no está definida en conexion.php.");
        }

        // Se usa 'email' como nombre de columna en la tabla usuarios
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = :correo");
        $stmt->execute([':correo' => $correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'] ?? $usuario['id_usuario'] ?? 1;
            $_SESSION['usuario_nombre'] = $usuario['nombre'] ?? 'Usuario';
            $_SESSION['usuario_correo'] = $usuario['email'] ?? $correo;

            header('Location: panel.php');
            exit;
        } else {
            header('Location: login.php?error=1');
            exit;
        }
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    header('Location: login.php');
    exit;
}