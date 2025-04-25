<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreacionTienda extends Authenticatable
{

    use HasApiTokens, HasFactory;

    protected $fillable = [
        'nombre_tienda',
        'responsable',
        'email',
        'tipo_de_tienda',
        'numero_tienda',
        'password',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
