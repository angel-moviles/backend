<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presentacion;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    public function index()
    {
        return response()->json(Presentacion::all(), 200);
    }

    public function show($id)
    {
        $item = Presentacion::find($id);

        if (!$item) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($item, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100'
        ]);

        return response()->json(Presentacion::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $item = Presentacion::find($id);

        if (!$item) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:100'
        ]);

        $item->update($data);

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Presentacion::find($id);

        if (!$item) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Eliminado'], 200);
    }
}
