<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = trim($_POST['nombre'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $empresa  = trim($_POST['empresa'] ?? '');
    $sector   = trim($_POST['sector'] ?? '');
    $tamano   = trim($_POST['tamano'] ?? '');
    $mensaje  = trim($_POST['mensaje'] ?? '');

    if (!empty($nombre) && !empty($correo)) {
        try {
            $sql = "INSERT INTO formulario_contacto (nombre, correo, telefono, empresa, sector, tamano, mensaje) 
                    VALUES (:nombre, :correo, :telefono, :empresa, :sector, :tamano, :mensaje)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':nombre'   => $nombre,
                ':correo'   => $correo,
                ':telefono' => $telefono,
                ':empresa'  => $empresa,
                ':sector'   => $sector,
                ':tamano'   => $tamano,
                ':mensaje'  => $mensaje
            ]);

            echo "<script>
                    alert('¡Formulario guardado con éxito en PostgreSQL!');
                    window.location.href = 'Formulario.html';
                  </script>";
        } catch (PDOException $e) {
            echo "Error al guardar los datos: " . $e->getMessage();
        }
    } else {
        echo "<script>
                alert('Por favor completa al menos Nombre y Correo.');
                window.history.back();
              </script>";
    }
}
?>