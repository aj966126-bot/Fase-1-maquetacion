<?php
// clientes/crear.php
// Formulario + lógica para registrar un cliente nuevo en PostgreSQL

require_once __DIR__ . '/../config/database.php';
// La conexión real de Wendry expone una función getConnection(): PDO

$errores = [];
$valores = [
    'nombre'     => '',
    'correo'     => '',
    'telefono'   => '',
    'empresa_id' => '',
];

$empresas = [];

try {
    $pdo = getConnection();

    // clientes.empresa_id es obligatorio (FK a empresas), así que necesitamos
    // ofrecer un selector con las empresas ya existentes.
    $stmtEmpresas = $pdo->query("SELECT id, nombre FROM empresas ORDER BY nombre");
    $empresas = $stmtEmpresas->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recibir información mediante PHP
        $valores['nombre']     = trim($_POST['nombre'] ?? '');
        $valores['correo']     = trim($_POST['correo'] ?? '');
        $valores['telefono']   = trim($_POST['telefono'] ?? '');
        $valores['empresa_id'] = trim($_POST['empresa_id'] ?? '');

        // Validar campos del lado servidor
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
        if ($valores['empresa_id'] === '' || !ctype_digit((string) $valores['empresa_id'])) {
            $errores[] = 'Debes seleccionar una empresa.';
        }

        if (empty($errores)) {
            // Preparar sentencia INSERT (consulta preparada, evita SQL injection)
            $stmt = $pdo->prepare(
                "INSERT INTO clientes (nombre, correo, telefono, empresa_id)
                 VALUES (:nombre, :correo, :telefono, :empresa_id)"
            );

            $stmt->execute([
                ':nombre'     => $valores['nombre'],
                ':correo'     => $valores['correo'],
                ':telefono'   => $valores['telefono'],
                ':empresa_id' => (int) $valores['empresa_id'],
            ]);

            // Registro exitoso -> volver al listado con mensaje de confirmación
            header('Location: index.php?creado=1');
            exit;
        }
    }
} catch (Throwable $e) {
    error_log('Error al crear cliente: ' . $e->getMessage());
    $errores[] = 'Ocurrió un error al conectar o guardar el cliente. Intenta de nuevo.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PymeGest - Nuevo cliente</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="page-container">
    <h1>Registrar nuevo cliente</h1>

    <?php if (!empty($errores)): ?>
      <ul class="alert alert-error">
        <?php foreach ($errores as $err): ?>
          <li><?php echo htmlspecialchars($err); ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="POST" action="crear.php" class="form-cliente">
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre"
             value="<?php echo htmlspecialchars($valores['nombre']); ?>" required>

      <label for="correo">Correo</label>
      <input type="email" id="correo" name="correo"
             value="<?php echo htmlspecialchars($valores['correo']); ?>" required>

      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" name="telefono"
             value="<?php echo htmlspecialchars($valores['telefono']); ?>" required>

      <label for="empresa_id">Empresa</label>
      <select id="empresa_id" name="empresa_id" required>
        <option value="">-- Selecciona una empresa --</option>
        <?php foreach ($empresas as $empresa): ?>
          <option value="<?php echo htmlspecialchars($empresa['id']); ?>"
            <?php echo ((string) $valores['empresa_id'] === (string) $empresa['id']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($empresa['nombre']); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (empty($empresas)): ?>
        <p class="alert alert-error">No hay empresas registradas todavía. Debe existir al menos una empresa antes de crear un cliente.</p>
      <?php endif; ?>

      <button type="submit" class="btn btn-primary">Guardar cliente</button>
      <a href="index.php" class="btn btn-outline">Cancelar</a>
    </form>
  </div>
</body>
</html>
