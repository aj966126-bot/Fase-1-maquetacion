<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = ['nombre', 'correo', 'telefono', 'empresa', 'sector', 'tamano', 'mensaje'];
}
