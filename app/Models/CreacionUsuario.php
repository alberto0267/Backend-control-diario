<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreacionUsuario extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'email',
        'numero_empleado',
        'numero_tienda',
        'tipo_de_tienda',
        'password',
        'admin',
        'subadmin',
    ];
}
