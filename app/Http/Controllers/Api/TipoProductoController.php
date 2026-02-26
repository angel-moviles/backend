<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index()
    {
        return response()->json(TipoProducto::all(), 200);
    }

    public function show($id)
    {
        $tipo = TipoProducto::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($tipo, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        return response()->json(TipoProducto::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoProducto::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:100'
        ]);

        $tipo->update($data);

        return response()->json($tipo, 200);
    }

    public function destroy($id)
    {
        $tipo = TipoProducto::find($id);

        if (!$tipo) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $tipo->delete();

        return response()->json(['message' => 'Eliminado'], 200);
    }
}
