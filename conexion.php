<?php
$host = 'localhost';
$port = '5432';
$dbname = 'pymegest';
$username = 'postgres';
$password = '123456'; // Coloca aquí la contraseña de tu usuario postgres en PostgreSQL

try {
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>