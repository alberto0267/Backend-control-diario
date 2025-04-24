<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/prueba', function (Request $request) {
    return response()->json([
        'mensaje' => '¡Funciona la API!'
    ]);
});

/*
En la siguiente ruta no estan protegidas porque aun no se registran 
*/
Route::post('/registro', [AuthController::class, 'register']);


/* apartir de aqui se protegen  */
Route::middleware('auth:sactum')->get('/mi-cuenta', function (Request $request) {
    return $request->user();
});
