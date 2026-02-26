<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $primaryKey = 'id_laboratorio';

    protected $fillable = [
        'nombre'
    ];
}
