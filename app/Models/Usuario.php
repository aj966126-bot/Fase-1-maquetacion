<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';
public $timestamps = false;
    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'telefono',
        'direccion',
    ];

    public function empresas(): HasMany
    {
        return $this->hasMany(Empresa::class, 'usuario_id');
    }
}
