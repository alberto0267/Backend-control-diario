<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreacionUsuario;
use App\Models\Fichaje;

class FichajeController extends Controller
{
    public function fichaje(Request $request)
    {

        $request->validate([
            'numero_empleado' => 'required|string',
            'tipo' => 'required|in:entrada,salida,descanso',
        ]);


        $empleado = CreacionUsuario::where('numero_empleado', $request->numero_empleado)->first();

        if (!$empleado) {
            return response()->json([
                'mensaje' => 'Empleado no encontrado'
            ], 404);
        }


        $yaFicho = Fichaje::where('user_id', $empleado->id)
            ->where('tipo', $request->tipo)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($yaFicho) {
            return response()->json([
                'mensaje' => 'Ya existe un fichaste hoy'
            ], 409);
        }

        $hora = now()->toTimeString();


        /**  */
        $datosFichaje = [
            'user_id' => $empleado->id,
            'tipo' => $request->tipo,
            'fecha' => now()->toDateString(),
        ];


        if ($request->tipo === 'entrada') {
            $datosFichaje['hora_entrada'] = $hora;
        } elseif ($request->tipo === 'salida') {
            $datosFichaje['hora_salida'] = $hora;
        } else {
            $datosFichaje['hora_descanso'] = $hora;
        }

        // Creamos el fichaje
        $fichaje = Fichaje::create($datosFichaje);

        return response()->json([
            'mensaje' => "Fichaje '{$request->tipo}' registrado correctamente",
            'fichaje' => $fichaje,
        ], 201);
    }
}
