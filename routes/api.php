<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/prueba', function (Request $request) {
    return response()->json([
        'mensaje' => '¡Funciona la API!'
    ]);
});
Route::post('/registro', [AuthController::class, 'register']);
