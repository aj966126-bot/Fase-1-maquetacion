<?php

require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? '';

if ($id === '' || !ctype_digit((string) $id)) {
    die('Cliente no válido.');
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

    die('No se pudo eliminar el cliente.');
}