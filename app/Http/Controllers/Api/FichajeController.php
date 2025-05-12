<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreacionUsuario;
use App\Models\Fichaje;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class FichajeController extends Controller
{
    public function fichaje(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:creacion_usuarios,id',
            'tipo' => 'required|in:entrada,salida,descanso',
            'fecha' => 'required|date',
        ]);

        $yaFicho = Fichaje::where('user_id', $request->user_id)
            ->where('tipo', $request->tipo)
            ->whereDate('fecha', $request->fecha)
            ->exists();

        if ($yaFicho) {
            return response()->json([
                'mensaje' => 'Ya existe un fichaje hoy de ese tipo'
            ], 409);
        }

        $datos = [
            'user_id' => $request->user_id,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
        ];

        if ($request->tipo === 'entrada') {
            $datos['hora_entrada'] = $request->hora_entrada;
        } elseif ($request->tipo === 'salida') {
            $datos['hora_salida'] = $request->hora_salida;
        } else {
            $datos['hora_descanso'] = $request->hora_descanso;
        }

        $fichaje = Fichaje::create($datos);

        return response()->json([
            'mensaje' => 'Fichaje registrado correctamente',
            'fichaje' => $fichaje,
        ], 200);
    }

    /* Para el hisrotial*/

    public function descargarPDF()
    {
        // Traer todos los usuarios con sus fichajes ya listos
        $usuarios = \App\Models\CreacionUsuario::with('fichajes')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.fichajes', [
            'usuarios' => $usuarios
        ]);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="fichajes.pdf"')
            ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
            ->header('Access-Control-Allow-Methods', 'GET')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
}
