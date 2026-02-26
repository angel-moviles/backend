<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table = 'venta_detalles';
    protected $primaryKey = 'id_venta_detalle';

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'id_venta',
        'id_producto'
    ];

    // 🔹 Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    // 🔹 Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
