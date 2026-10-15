<?php

use App\Models\Usuario;

return [

    /*
    |--------------------------------------------------------------------------
    | Configuración predeterminada
    |--------------------------------------------------------------------------
    | Utiliza sesiones para mantener autenticados a los usuarios.
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'usuarios',
    ],

    /*
    |--------------------------------------------------------------------------
    | Protección de autenticación
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedor de usuarios
    |--------------------------------------------------------------------------
    | Utiliza el modelo Usuario y la tabla usuarios.
    */
    'providers' => [
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => Usuario::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Recuperación de contraseñas
    |--------------------------------------------------------------------------
    | Se conserva la configuración para una futura implementación.
    */
    'passwords' => [
        'usuarios' => [
            'provider' => 'usuarios',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de confirmación
    |--------------------------------------------------------------------------
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];