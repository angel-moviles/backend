<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return response()->json(Proveedor::all(), 200);
    }

    public function show($id)
    {
        $prov = Proveedor::find($id);

        if (!$prov) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($prov, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email',
            'nombre_contacto' => 'nullable|string|max:150',
            'fecha_ingreso' => 'required|date',
            'activo' => 'boolean'
        ]);

        return response()->json(Proveedor::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $prov = Proveedor::find($id);

        if (!$prov) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:150',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email',
            'nombre_contacto' => 'nullable|string|max:150',
            'fecha_ingreso' => 'sometimes|date',
            'activo' => 'boolean'
        ]);

        $prov->update($data);

        return response()->json($prov, 200);
    }

    public function destroy($id)
    {
        $prov = Proveedor::find($id);

        if (!$prov) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $prov->delete();

        return response()->json(['message' => 'Eliminado'], 200);
    }
}
