<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = $_POST['id'] ?? '';

if ($id === '' || !ctype_digit((string) $id)) {
    header('Location: index.php');
    exit;
}

try {
    $pdo = getConnection();

    $stmt = $pdo->prepare(
        "DELETE FROM clientes WHERE id = :id"
    );

    $stmt->execute([
        ':id' => (int) $id
    ]);

    header('Location: index.php?eliminado=1');
    exit;
} catch (Throwable $e) {
    error_log('Error al eliminar cliente: ' . $e->getMessage());
    header('Location: index.php?error=eliminar');
    exit;
}