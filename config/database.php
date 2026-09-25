<?php

function getConnection(): PDO
{
    $envFile = __DIR__ . '/.env';

    if (!file_exists($envFile)) {
        throw new RuntimeException('No se encontró el archivo .env');
    }

    $config = parse_ini_file($envFile, false, INI_SCANNER_RAW);

    if ($config === false) {
        throw new RuntimeException('No se pudo leer el archivo .env');
    }

    $required = [
        'DB_HOST',
        'DB_PORT',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD'
    ];

    foreach ($required as $key) {
        if (!isset($config[$key]) || $config[$key] === '') {
            throw new RuntimeException("Falta la configuración: {$key}");
        }
    }

    $dsn = "pgsql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_NAME']}";

    try {
        return new PDO(
            $dsn,
            $config['DB_USER'],
            $config['DB_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    } catch (PDOException $e) {
        throw new RuntimeException(
            'No fue posible conectar con PostgreSQL.',
            0,
            $e
        );
    }
}