<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
    // 🔹 GET todos
    public function index()
    {
        $detalles = VentaDetalle::with(['venta', 'producto'])->get();
        return response()->json($detalles, 200);
    }

    // 🔹 GET uno
    public function show($id)
    {
        $detalle = VentaDetalle::with(['venta', 'producto'])
            ->find($id);

        if (!$detalle) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($detalle, 200);
    }

    // 🔹 POST crear
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        // 🔥 calcular subtotal automáticamente
        $data['subtotal'] = $data['cantidad'] * $data['precio_unitario'];

        $detalle = VentaDetalle::create($data);

        return response()->json($detalle, 201);
    }

    // 🔹 PUT / PATCH
    public function update(Request $request, $id)
    {
        $detalle = VentaDetalle::find($id);

        if (!$detalle) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $data = $request->validate([
            'cantidad' => 'sometimes|integer|min:1',
            'precio_unitario' => 'sometimes|numeric|min:0',
            'id_producto' => 'sometimes|exists:productos,id_producto'
        ]);

        // recalcular subtotal si cambia algo
        $cantidad = $data['cantidad'] ?? $detalle->cantidad;
        $precio = $data['precio_unitario'] ?? $detalle->precio_unitario;
        $data['subtotal'] = $cantidad * $precio;

        $detalle->update($data);

        return response()->json($detalle, 200);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $detalle = VentaDetalle::find($id);

        if (!$detalle) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $detalle->delete();

        return response()->json(['message' => 'Eliminado'], 200);
    }
}
