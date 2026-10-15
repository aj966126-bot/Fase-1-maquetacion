<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    /*
    |--------------------------------------------------------------------------
    | Configuración del modelo
    |--------------------------------------------------------------------------
    | Utiliza la tabla usuarios de PostgreSQL.
    */
    protected $table = 'usuarios';

    public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    | Campos permitidos
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'telefono',
        'direccion',
    ];

    /*
    |--------------------------------------------------------------------------
    | Campos protegidos
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'contrasena',
    ];

    /*
    |--------------------------------------------------------------------------
    | Contraseña de autenticación
    |--------------------------------------------------------------------------
    | Laravel utilizará el campo contrasena.
    */
    public function getAuthPasswordName(): string
    {
        return 'contrasena';
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */
    public function empresas(): HasMany
    {
        return $this->hasMany(Empresa::class, 'usuario_id');
    }
}