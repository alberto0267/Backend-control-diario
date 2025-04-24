<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('creacion_tiendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_jefe');
            $table->string('apellido_jefe');
            $table->string('email')->unique();
            $table->string('tipo_de_tienda');
            $table->string('numero_tienda');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creacion_tiendas');
    }
};
