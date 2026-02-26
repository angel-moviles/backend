<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // 🔹 GET todos
    public function index()
    {
        return response()->json(
            Producto::with([
                'laboratorio',
                'tipo',
                'presentacion',
                'proveedor'
            ])->get()
        );
    }

    // 🔹 GET por ID
    public function show($id)
    {
        return response()->json(
            Producto::with([
                'laboratorio',
                'tipo',
                'presentacion',
                'proveedor'
            ])->findOrFail($id)
        );
    }

    // 🔹 POST
    public function store(Request $request)
    {
        $data = $request->validate([
            'lote' => 'required|string|max:50|unique:productos,lote',
            'nombre' => 'required|string|max:150',
            'fecha_produccion' => 'required|date',
            'fecha_caducidad' => 'required|date|after:fecha_produccion',
            'costo' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'stock_minimo' => 'nullable|integer|min:0',
            'activo' => 'boolean',
            'id_laboratorio' => 'required|exists:laboratorios,id_laboratorio',
            'id_tipo_producto' => 'required|exists:tipo_productos,id_tipo_producto',
            'id_presentacion' => 'required|exists:presentacions,id_presentacion',
            'id_proveedor' => 'required|exists:proveedors,id_proveedor'
        ]);

        $producto = Producto::create($data);

        return response()->json($producto, 201);
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'lote' => 'sometimes|string|max:50|unique:productos,lote,' . $id . ',id_producto',
            'nombre' => 'sometimes|string|max:150',
            'fecha_produccion' => 'sometimes|date',
            'fecha_caducidad' => 'sometimes|date',
            'costo' => 'sometimes|numeric|min:0',
            'precio_venta' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'stock_minimo' => 'sometimes|integer|min:0',
            'activo' => 'boolean',
            'id_laboratorio' => 'sometimes|exists:laboratorios,id_laboratorio',
            'id_tipo_producto' => 'sometimes|exists:tipo_productos,id_tipo_producto',
            'id_presentacion' => 'sometimes|exists:presentacions,id_presentacion',
            'id_proveedor' => 'sometimes|exists:proveedors,id_proveedor'
        ]);

        $producto->update($data);

        return response()->json($producto);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(['message' => 'Producto eliminado']);
    }
}
