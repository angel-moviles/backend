<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $primaryKey = 'id_presentacion';

    protected $fillable = [
        'nombre'
    ];  
}
