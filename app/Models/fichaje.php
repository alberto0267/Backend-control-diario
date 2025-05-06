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
        'hora_fichaje'
    ];

    public function usuario()

    /* Este fichaje pertenecea a un usuario*/
    {
        return $this->belongsTo(CreacionUsuario::class, 'user_id');
    }
}
