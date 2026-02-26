<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $primaryKey = 'id_tipo_producto';

    protected $fillable = [
        'nombre'
    ];
}
