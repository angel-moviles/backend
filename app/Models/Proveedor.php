<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'nombre_contacto',
        'fecha_ingreso',
        'activo'
    ];
}
