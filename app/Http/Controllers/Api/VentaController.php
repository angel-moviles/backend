<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Listar
    public function index()
    {
        return Venta::with('usuario')->get();
    }

    // Crear
    public function store(Request $request)
    {
        $venta = Venta::create($request->all());
        return response()->json($venta, 201);
    }

    // Mostrar
    public function show($id)
    {
        return Venta::with('detalles')->findOrFail($id);
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->update($request->all());
        return response()->json($venta);
    }

    // Eliminar
    public function destroy($id)
    {
        Venta::destroy($id);
        return response()->json(['message' => 'Eliminado']);
    }
}
