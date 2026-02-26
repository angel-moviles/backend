<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // 🔹 GET /api/roles
    public function index()
    {
        return response()->json(Rol::all(), 200);
    }

    // 🔹 GET /api/roles/{id}
    public function show($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol, 200);
    }

    // 🔹 POST /api/roles
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:150'
        ]);

        $rol = Rol::create($data);

        return response()->json($rol, 201);
    }

    // 🔹 PUT /api/roles/{id}
    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:50',
            'descripcion' => 'nullable|string|max:150'
        ]);

        $rol->update($data);

        return response()->json($rol, 200);
    }

    // 🔹 DELETE /api/roles/{id}
    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->delete();

        return response()->json(['message' => 'Rol eliminado'], 200);
    }
}
