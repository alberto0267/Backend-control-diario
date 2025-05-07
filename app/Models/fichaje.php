<?php


/*<lo creo con menos porque no necsito que tenga token
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fichaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'hora_descanso',
    ];

    public function usuario()

    /* Este fichaje pertenecea a un usuario*/
    {
        return $this->belongsTo(CreacionUsuario::class, 'user_id');
    }
}
