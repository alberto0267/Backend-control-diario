<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creacion_usuarios', function (Blueprint $table) {
            $table->id();

            // Campos básicos con longitudes específicas
            $table->string('nombre', 100);
            $table->string('email', 255)->unique();

            // Números enteros optimizados
            $table->smallInteger('numero_empleado')->unique();
            $table->smallInteger('numero_tienda');

            // Campos de texto con longitud apropiada
            $table->string('tipo_de_tienda', 50);
            $table->string('password', 255);

            // Campos booleanos con valores por defecto explícitos
            $table->boolean('admin')->default(false);
            $table->boolean('subadmin')->default(false);

            // Campos especiales de Laravel
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creacion_usuarios');
    }
};
