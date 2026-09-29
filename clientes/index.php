<?php
// clientes/index.php
// Muestra el listado de clientes obtenido desde PostgreSQL

require_once __DIR__ . '/../config/database.php';
// La conexión real de Wendry expone una función getConnection(): PDO
// (no una variable $pdo suelta), así que la llamamos aquí.

$mensaje = '';
if (isset($_GET['creado']) && $_GET['creado'] === '1') {
    $mensaje = 'Cliente registrado correctamente.';
}

$clientes = [];
$error = '';

try {
    $pdo = getConnection();
    // clientes.empresa_id es obligatorio y referencia a empresas,
    // así que unimos (JOIN) para mostrar el nombre de la empresa en vez del id.
    $stmt = $pdo->prepare(
        "SELECT c.id, c.nombre, c.correo, c.telefono, e.nombre AS empresa
         FROM clientes c
         JOIN empresas e ON c.empresa_id = e.id
         ORDER BY c.id DESC"
    );
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // No mostramos el error real de la BD al usuario final, solo lo registramos.
    error_log('Error al leer clientes: ' . $e->getMessage());
    $error = 'Ocurrió un error al cargar los clientes. Intenta de nuevo más tarde.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PymeGest - Clientes</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="page-container">
    <h1>Clientes registrados</h1>

    <a href="crear.php" class="btn btn-primary">+ Nuevo cliente</a>

    <?php if ($mensaje): ?>
      <p class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p class="alert alert-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (empty($clientes) && !$error): ?>
      <p class="empty-state">Todavía no hay clientes registrados.</p>
    <?php else: ?>
      <table class="tabla-clientes">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Empresa</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
              <td><?php echo htmlspecialchars($cliente['id']); ?></td>
              <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
              <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
              <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
              <td><?php echo htmlspecialchars($cliente['empresa']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>
