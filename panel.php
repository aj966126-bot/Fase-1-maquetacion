<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario_correo'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - PymeGest</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background-color: #f4f6f9; }
        .card { background: white; padding: 30px; border-radius: 8px; max-width: 500px; margin: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .btn { display: inline-block; padding: 10px 15px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>¡Bienvenido a PymeGest!</h1>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario'); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['usuario_correo']); ?></p>
        <a href="logout.php" class="btn">Cerrar Sesión</a>
    </div>
</body>
</html>