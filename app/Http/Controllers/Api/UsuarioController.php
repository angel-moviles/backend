<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // 🔹 GET todos
    public function index()
    {
        return response()->json(
            Usuario::with('rol')->get(),
            200
        );
    }

    // 🔹 GET uno
    public function show($id)
    {
        $user = Usuario::with('rol')->find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user, 200);
    }

    // 🔹 POST crear
    public function store(Request $request)
    {
        $data = $request->validate([
            'clave_usuario' => 'required|string|max:50|unique:usuarios',
            'nombre' => 'required|string|max:100',
            'a_paterno' => 'required|string|max:100',
            'a_materno' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:usuarios',
            'foto' => 'nullable|string',
            'contrasena' => 'required|min:6',
            'activo' => 'boolean',
            'id_rol' => 'required|exists:rols,id_rol'
        ]);

        // 🔐 Hashear contraseña
        $data['contrasena'] = Hash::make($data['contrasena']);

        $user = Usuario::create($data);

        return response()->json($user, 201);
    }

    // 🔹 PUT actualizar
    public function update(Request $request, $id)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $data = $request->validate([
            'clave_usuario' => 'sometimes|string|max:50|unique:usuarios,clave_usuario,' . $id . ',id_usuario',
            'nombre' => 'sometimes|string|max:100',
            'a_paterno' => 'sometimes|string|max:100',
            'a_materno' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'sometimes|date',
            'sexo' => 'sometimes|in:M,F',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'sometimes|email|unique:usuarios,correo,' . $id . ',id_usuario',
            'foto' => 'nullable|string',
            'contrasena' => 'nullable|min:6',
            'activo' => 'boolean',
            'id_rol' => 'sometimes|exists:rols,id_rol'
        ]);

        // Si manda nueva contraseña
        if (isset($data['contrasena'])) {
            $data['contrasena'] = Hash::make($data['contrasena']);
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
}
