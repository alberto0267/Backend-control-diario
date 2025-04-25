<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;

Route::get('/prueba', function (Request $request) {
    return response()->json([
        'mensaje' => '¡Funciona la API!'
    ]);
});

/*
En la siguiente ruta no estan protegidas porque aun no se registran 
*/
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/registroStore', [StoreController::class, 'registerStore']);

/* apartir de aqui se protegen  */
Route::middleware('auth:sactum')->get('/mi-cuenta', function (Request $request) {
    return $request->user();
});
