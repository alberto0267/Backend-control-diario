<?php

namespace Database\Seeders;

use App\Models\CreacionUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreacionUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new CreacionUsuario();
        $user->nombre = "Victor Ramirez";
        $user->email = "Victor@gmail.com";
        $user->numero_empleado = "00001";
        $user->numero_tienda = "00001";
        $user->tipo_de_tienda = 'farmacia';
        $user->password = bcrypt('2672670');
        $user->admin = true;
        $user->subadmin = true;
        $user->save();
    }
}
