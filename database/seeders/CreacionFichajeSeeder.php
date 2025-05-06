<?php

namespace Database\Seeders;

use App\Models\Fichaje;

use App\Models\CreacionUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreacionFichajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $numero_empleado = "210";
        $tipo = "entrada";
        $empleado = CreacionUsuario::where('numero_empleado', $numero_empleado)->first();


        if ($empleado) {

            $fichaje = new Fichaje();
            $fichaje->user_id = $empleado->id;
            $fichaje->tipo = $tipo;
            $fichaje->fecha = now()->toDateString();
            if ($tipo === 'entrada') {
                $fichaje->hora_entrada = '08:00:00';
                // $fichaje->hora_salida = null;
            } elseif ($tipo === 'salida') {
                $fichaje->hora_salida = '14:00:00';
                // $fichaje->hora_entrada = null;
            } else {
                $fichaje->hora_descanso = '14:00';
            }
            $fichaje->save();
            echo "Fichajes creados para {$empleado->nombre} (Empleado Nº {$empleado->numero_empleado})\n";
        } else {
            echo 'Empleado con numero {$numero_empleado} no encontrado\n';
        }
    }
}
