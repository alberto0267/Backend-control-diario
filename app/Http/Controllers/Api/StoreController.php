<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CreacionTienda;

class StoreController extends Controller
{

    public function registerStore(Request $request)
    {

        $request->validate(
            [
                'nombre_tienda' => 'required|string|max:100',
                'responsable' => 'required|string|',
                'email' => 'required|string|unique:creacion_tiendas,email',

                'tipo_de_tienda' => 'required|string|max:100',
                'numero_tienda' => 'required|integer',
                'password' => 'required|string|min:6',

            ]
        );
        $tienda = CreacionTienda::create(
            [
                'nombre_tienda' => $request->nombre_tienda,
                'responsable' => $request->responsable,
                'email' => $request->email,
                'tipo_de_tienda' => $request->tipo_de_tienda,
                'numero_tienda' => $request->numero_tienda,
                'password' => Hash::make($request->password),
            ]
        );

        $token = $tienda->createToken('tokenStore-control-diario')->plainTextToken;

        return response()->json([
            'token' => $token,
            'tienda' => $tienda,

        ], 201);
    }
}
