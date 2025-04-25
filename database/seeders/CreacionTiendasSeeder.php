<?php

namespace Database\Seeders;

use App\Models\CreacionTienda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreacionTiendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //  'nombre_tienda',
    //  'responsable',
    //  'email',
    //  'tipo_de_tienda',
    //  'numero_tienda',
    //  'password',
    public function run(): void
    {
        //
        $tienda = new CreacionTienda();
        $tienda->nombre_tienda = 'Fumigaciones Up';
        $tienda->responsable = 'Alberto';
        $tienda->email = 'albertoblanco.r@gmail.com';
        $tienda->tipo_de_tienda = 'Fumigaciones';
        $tienda->numero_tienda = '267';
        $tienda->password = bcrypt('20665818');
        $tienda->save();
    }
}
