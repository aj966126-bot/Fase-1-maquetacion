<?php
declare(strict_types=1);

$pdoPgsqlHabilitado = extension_loaded("pdo_pgsql");
$pgsqlHabilitado = extension_loaded("pgsql");
$controladoresPdo = class_exists("PDO") ? PDO::getAvailableDrivers() : [];
$postgresDisponible = in_array("pgsql", $controladoresPdo, true);
$entornoListo = $pdoPgsqlHabilitado && $pgsqlHabilitado && $postgresDisponible;

function mostrarEstado(bool $habilitado): string
{
    return $habilitado ? "Habilitado" : "No habilitado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Comprobación del entorno | PymeGest</title>
    <style>
        body {
            max-width: 760px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: Arial, sans-serif;
            color: #1f2933;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccd3da;
            text-align: left;
        }

        th {
            width: 42%;
            background: #eaf3fb;
        }

        .resultado {
            padding: 16px;
            border-radius: 8px;
            font-weight: 700;
        }

        .correcto {
            background: #d1e7dd;
            color: #0f5132;
        }

        .pendiente {
            background: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body>
    <main>
        <h1>Comprobación del entorno local de PymeGest</h1>
        <p>Este archivo valida la ejecución de PHP desde Apache y la disponibilidad del controlador PostgreSQL mediante PDO.</p>

        <p class="resultado <?php echo $entornoListo ? "correcto" : "pendiente"; ?>">
            <?php echo $entornoListo ? "Entorno preparado para usar PostgreSQL mediante PDO." : "El entorno requiere revisar la configuración de PostgreSQL mediante PDO."; ?>
        </p>

        <table>
            <tbody>
                <tr>
                    <th>Versión de PHP</th>
                    <td><?php echo htmlspecialchars(PHP_VERSION, ENT_QUOTES, "UTF-8"); ?></td>
                </tr>
                <tr>
                    <th>Interfaz de ejecución</th>
                    <td><?php echo htmlspecialchars(PHP_SAPI, ENT_QUOTES, "UTF-8"); ?></td>
                </tr>
                <tr>
                    <th>Archivo de configuración</th>
                    <td><?php echo htmlspecialchars((string) php_ini_loaded_file(), ENT_QUOTES, "UTF-8"); ?></td>
                </tr>
                <tr>
                    <th>Extensión pdo_pgsql</th>
                    <td><?php echo mostrarEstado($pdoPgsqlHabilitado); ?></td>
                </tr>
                <tr>
                    <th>Extensión pgsql</th>
                    <td><?php echo mostrarEstado($pgsqlHabilitado); ?></td>
                </tr>
                <tr>
                    <th>Controladores PDO</th>
                    <td><?php echo htmlspecialchars(implode(", ", $controladoresPdo), ENT_QUOTES, "UTF-8"); ?></td>
                </tr>
            </tbody>
        </table>

        <p>Resultado esperado: PHP ejecutado por Apache y <code>pgsql</code> incluido en los controladores PDO.</p>
    </main>
</body>
</html>
