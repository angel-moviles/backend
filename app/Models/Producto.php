<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'lote',
        'nombre',
        'fecha_produccion',
        'fecha_caducidad',
        'costo',
        'precio_venta',
        'stock',
        'stock_minimo',
        'activo',
        'id_laboratorio',
        'id_tipo_producto',
        'id_presentacion',
        'id_proveedor'
    ];

    // 🔗 Relaciones
    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'id_laboratorio');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoProducto::class, 'id_tipo_producto');
    }

    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class, 'id_presentacion');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
