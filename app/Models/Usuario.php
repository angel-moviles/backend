<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'clave_usuario',
        'nombre',
        'a_paterno',
        'a_materno',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'correo',
        'foto',
        'contrasena',
        'activo',
        'id_rol'
    ];

    protected $hidden = ['contrasena'];

    // 👇 MUY IMPORTANTE
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}