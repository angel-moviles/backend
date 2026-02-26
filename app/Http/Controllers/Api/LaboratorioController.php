<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function index()
    {
        return response()->json(Laboratorio::all(), 200);
    }

    public function show($id)
    {
        $lab = Laboratorio::find($id);

        if (!$lab) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($lab, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150'
        ]);

        return response()->json(Laboratorio::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $lab = Laboratorio::find($id);

        if (!$lab) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:150'
        ]);

        $lab->update($data);

        return response()->json($lab, 200);
    }

    public function destroy($id)
    {
        $lab = Laboratorio::find($id);

        if (!$lab) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $lab->delete();

        return response()->json(['message' => 'Eliminado'], 200);
    }
}
