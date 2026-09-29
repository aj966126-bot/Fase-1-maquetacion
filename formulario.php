<?php

require_once __DIR__ . '/config/database.php';

$errores = [];
$exito = false;

$datos = [
    'nombre' => '',
    'correo' => '',
    'telefono' => '',
    'empresa' => '',
    'sector' => '',
    'tamano' => '',
    'mensaje' => ''
];

$sectoresPermitidos = [
    'comercio',
    'servicios',
    'tecnologia',
    'manufactura',
    'agricultura',
    'otro'
];

$tamanosPermitidos = [
    'micro',
    'pequena',
    'mediana'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim($_POST[$campo] ?? '');
    }

    if ($datos['nombre'] === '') {
        $errores['nombre'] = 'Escribe tu nombre completo.';
    }

    if (
        $datos['correo'] === '' ||
        !filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)
    ) {
        $errores['correo'] = 'Introduce un correo electrónico válido.';
    }

    if (
        $datos['telefono'] === '' ||
        !preg_match('/^\((809|829|849)\)\s\d{3}-\d{4}$/', $datos['telefono'])
    ) {
        $errores['telefono'] =
            'Usa el formato (809) 000-0000, (829) 000-0000 o (849) 000-0000.';
    }

    if ($datos['empresa'] === '') {
        $errores['empresa'] = 'Escribe el nombre de tu empresa.';
    }

    if (!in_array($datos['sector'], $sectoresPermitidos, true)) {
        $errores['sector'] = 'Selecciona un sector válido.';
    }

    if (!in_array($datos['tamano'], $tamanosPermitidos, true)) {
        $errores['tamano'] = 'Selecciona el tamaño de la empresa.';
    }

    if (empty($errores)) {
        try {
            $conexion = getConnection();

            $sql = '
                INSERT INTO solicitudes (
                    nombre,
                    correo,
                    telefono,
                    empresa,
                    sector,
                    tamano,
                    mensaje
                )
                VALUES (
                    :nombre,
                    :correo,
                    :telefono,
                    :empresa,
                    :sector,
                    :tamano,
                    :mensaje
                )
            ';

            $stmt = $conexion->prepare($sql);

            $stmt->execute([
                ':nombre' => $datos['nombre'],
                ':correo' => $datos['correo'],
                ':telefono' => $datos['telefono'],
                ':empresa' => $datos['empresa'],
                ':sector' => $datos['sector'],
                ':tamano' => $datos['tamano'],
                ':mensaje' => $datos['mensaje'] !== ''
                    ? $datos['mensaje']
                    : null
            ]);

            $exito = true;

            foreach ($datos as $campo => $valor) {
                $datos[$campo] = '';
            }
        } catch (Throwable $e) {
            $errores['general'] =
                'No fue posible registrar la información. Inténtalo nuevamente.';
        }
    }
}

function escapar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

function errorCampo(array $errores, string $campo): string
{
    return isset($errores[$campo]) ? ' campo-invalido' : '';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        name="description"
        content="Formulario empresarial de PymeGest."
    >
    <title>Formulario | PymeGest</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- ENCABEZADO -->
    <header class="encabezado">
        <div class="contenedor header-contenido">

            <div class="logo">
                <a href="index.html">
                    <img
                        src="img/logo-pymegest.jpeg"
                        alt="Logo de PymeGest"
                    >
                </a>
            </div>

            <nav
                class="menu-navegacion"
                aria-label="Menú principal"
            >
                <ul>
                    <li>
                        <a href="index.html">Inicio</a>
                    </li>

                    <li>
                        <a href="informacion.html">
                            Información
                        </a>
                    </li>

                    <li>
                        <a
                            href="formulario.php"
                            class="activo"
                        >
                            Formulario
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </header>


    <main>

        <!-- HERO -->
        <section class="pagina-hero">
            <div class="contenedor contenido-centrado">

                <span class="etiqueta">Contacto</span>

                <h1>Conoce más sobre PymeGest</h1>

                <p>
                    Completa el siguiente formulario para compartir
                    información sobre tu empresa.
                </p>

            </div>
        </section>


        <!-- FORMULARIO -->
        <section class="seccion">

            <div class="contenedor formulario-contenedor">

                <div class="formulario-introduccion">

                    <span class="etiqueta">
                        Información empresarial
                    </span>

                    <h2>Cuéntanos sobre tu empresa</h2>

                    <p>
                        Completa los campos para conocer mejor
                        las necesidades de tu negocio.
                    </p>

                    <div class="formulario-nota">
                        <strong>Importante:</strong>
                        La información enviada será registrada
                        en PymeGest para su gestión y seguimiento.
                    </div>

                </div>


                <!-- FORMULARIO -->
                <form
                    id="formularioPymeGest"
                    class="formulario"
                    action="formulario.php"
                    method="post"
                    novalidate
                >

                    <?php if ($exito): ?>
                        <div
                            class="mensaje-error exito"
                            role="status"
                            aria-live="polite"
                        >
                            Información registrada correctamente.
                            Gracias por completar el formulario.
                        </div>
                    <?php endif; ?>

                    <?php if (isset($errores['general'])): ?>
                        <div
                            class="mensaje-error error"
                            role="alert"
                            aria-live="assertive"
                        >
                            <?= escapar($errores['general']) ?>
                        </div>
                    <?php endif; ?>


                    <!-- NOMBRE -->
                    <div class="campo">

                        <label for="nombre">
                            Nombre completo
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="<?= errorCampo($errores, 'nombre') ?>"
                            value="<?= escapar($datos['nombre']) ?>"
                            placeholder="Ej. Juan Pérez"
                            required
                        >

                        <small
                            id="error-nombre"
                            class="error-campo"
                        >
                            <?= isset($errores['nombre'])
                                ? escapar($errores['nombre'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- CORREO -->
                    <div class="campo">

                        <label for="correo">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="<?= errorCampo($errores, 'correo') ?>"
                            value="<?= escapar($datos['correo']) ?>"
                            placeholder="ejemplo@correo.com"
                            required
                        >

                        <small
                            id="error-correo"
                            class="error-campo"
                        >
                            <?= isset($errores['correo'])
                                ? escapar($errores['correo'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- TELÉFONO -->
                    <div class="campo">

                        <label for="telefono">
                            Teléfono
                        </label>

                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="<?= errorCampo($errores, 'telefono') ?>"
                            value="<?= escapar($datos['telefono']) ?>"
                            placeholder="(809) 000-0000"
                            required
                        >

                        <small
                            id="error-telefono"
                            class="error-campo"
                        >
                            <?= isset($errores['telefono'])
                                ? escapar($errores['telefono'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- EMPRESA -->
                    <div class="campo">

                        <label for="empresa">
                            Nombre de la empresa
                        </label>

                        <input
                            type="text"
                            id="empresa"
                            name="empresa"
                            class="<?= errorCampo($errores, 'empresa') ?>"
                            value="<?= escapar($datos['empresa']) ?>"
                            placeholder="Nombre de tu empresa"
                            required
                        >

                        <small
                            id="error-empresa"
                            class="error-campo"
                        >
                            <?= isset($errores['empresa'])
                                ? escapar($errores['empresa'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- SECTOR -->
                    <div class="campo">

                        <label for="sector">
                            Sector de la empresa
                        </label>

                        <select
                            id="sector"
                            name="sector"
                            class="<?= errorCampo($errores, 'sector') ?>"
                            required
                        >

                            <option value="">
                                Selecciona una opción
                            </option>

                            <option
                                value="comercio"
                                <?= $datos['sector'] === 'comercio'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Comercio
                            </option>

                            <option
                                value="servicios"
                                <?= $datos['sector'] === 'servicios'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Servicios
                            </option>

                            <option
                                value="tecnologia"
                                <?= $datos['sector'] === 'tecnologia'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Tecnología
                            </option>

                            <option
                                value="manufactura"
                                <?= $datos['sector'] === 'manufactura'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Manufactura
                            </option>

                            <option
                                value="agricultura"
                                <?= $datos['sector'] === 'agricultura'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Agricultura
                            </option>

                            <option
                                value="otro"
                                <?= $datos['sector'] === 'otro'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Otro
                            </option>

                        </select>

                        <small
                            id="error-sector"
                            class="error-campo"
                        >
                            <?= isset($errores['sector'])
                                ? escapar($errores['sector'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- TAMAÑO -->
                    <div class="campo">

                        <label for="tamano">
                            Tamaño de la empresa
                        </label>

                        <select
                            id="tamano"
                            name="tamano"
                            class="<?= errorCampo($errores, 'tamano') ?>"
                            required
                        >

                            <option value="">
                                Selecciona una opción
                            </option>

                            <option
                                value="micro"
                                <?= $datos['tamano'] === 'micro'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Microempresa
                            </option>

                            <option
                                value="pequena"
                                <?= $datos['tamano'] === 'pequena'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Pequeña empresa
                            </option>

                            <option
                                value="mediana"
                                <?= $datos['tamano'] === 'mediana'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Mediana empresa
                            </option>

                        </select>

                        <small
                            id="error-tamano"
                            class="error-campo"
                        >
                            <?= isset($errores['tamano'])
                                ? escapar($errores['tamano'])
                                : '' ?>
                        </small>

                    </div>


                    <!-- MENSAJE -->
                    <div class="campo campo-completo">

                        <label for="mensaje">
                            Mensaje o comentario
                        </label>

                        <textarea
                            id="mensaje"
                            name="mensaje"
                            rows="6"
                            placeholder="Cuéntanos brevemente sobre tu empresa..."
                        ><?= escapar($datos['mensaje']) ?></textarea>

                    </div>


                    <!-- MENSAJE GENERAL DE JAVASCRIPT -->
                    <div
                        id="mensajeError"
                        class="mensaje-error"
                        role="alert"
                        aria-live="polite"
                    ></div>


                    <!-- BOTONES -->
                    <div
                        class="campo-completo formulario-acciones"
                    >

                        <button
                            type="submit"
                            class="boton boton-primario"
                        >
                            Enviar formulario
                        </button>

                        <button
                            type="reset"
                            class="boton boton-secundario"
                        >
                            Limpiar
                        </button>

                    </div>

                </form>

            </div>

        </section>


        <!-- COMPONENTE DINÁMICO -->
        <section class="seccion-buscador-sector">

            <div class="contenedor-buscador-sector">

                <h2>Buscador de sectores</h2>

                <p>
                    Escribe el nombre de un sector para consultar
                    las opciones disponibles en PymeGest.
                </p>

                <input
                    type="text"
                    id="buscadorSector"
                    placeholder="Escribe un sector..."
                >

                <ul id="resultadosSector"></ul>

            </div>

        </section>

    </main>


    <!-- FOOTER -->
    <footer class="pie-pagina">

        <div class="contenedor footer-grid">

            <div class="footer-info">

                <a
                    href="index.html"
                    class="logo-footer"
                >
                    <img
                        src="img/logo-pymegest.jpeg"
                        alt="Logo de PymeGest"
                    >
                </a>

                <p>
                    Plataforma web orientada a facilitar
                    la gestión de pequeñas y medianas empresas.
                </p>

            </div>


            <div class="footer-enlaces">

                <h3>Enlaces</h3>

                <ul>

                    <li>
                        <a href="index.html">
                            Inicio
                        </a>
                    </li>

                    <li>
                        <a href="informacion.html">
                            Información
                        </a>
                    </li>

                    <li>
                        <a href="formulario.php">
                            Formulario
                        </a>
                    </li>

                </ul>

            </div>


            <div class="footer-contacto">

                <h3>Contacto</h3>

                <address>

                    <p>
                        contacto@pymegest.com
                    </p>

                    <p>
                        (809) 000-0000
                    </p>

                    <p>
                        Santiago, República Dominicana
                    </p>

                </address>

            </div>

        </div>


        <div class="footer-copy">

            <p>
                &copy; 2026 PymeGest.
                Proyecto académico UAPA.
            </p>

        </div>

    </footer>


    <script src="js/script.js"></script>

</body>

</html>