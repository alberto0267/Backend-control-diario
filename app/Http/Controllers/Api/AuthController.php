<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CreacionUsuario;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:creacion_usuarios,email',
            'numero_empleado' => 'required|integer|unique:creacion_usuarios,numero_empleado',
            'numero_tienda' => 'required|integer',
            'tipo_de_tienda' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $usuario = CreacionUsuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'numero_empleado' => $request->numero_empleado,
            'numero_tienda' => $request->numero_tienda,
            'tipo_de_tienda' => $request->tipo_de_tienda,
            'password' => Hash::make($request->password),
        ]);

        $token = $usuario->createToken('token-control-diario')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usuario' => $usuario,
        ], 201);
    }
}
