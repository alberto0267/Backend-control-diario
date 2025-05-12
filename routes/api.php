<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\FichajeController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\CreacionUsuario;

Route::get('/prueba', function (Request $request) {
    return response()->json([
        'mensaje' => '¡Funciona la API!'
    ]);
});

Route::post('/login', function (Request $request) {


    $validacion = Validator::make($request->all(), [
        'email' => ['required', 'email'],
        'password' => ['required'],


    ]);



    if ($validacion->fails()) {
        return response()->json([
            'errores' => $validacion->errors()
        ], 422);
    }

    $user = CreacionUsuario::where('email', $request->email)->first();

    // $passwordEncriptado = Hash::make($request->password)->first;


    // Hash::check('contraseña normal', 'hash en la base de datos')
    //has devuelve true si son iguales 
    if (!$user ||  !Hash::check($request->password, $user->password)) {

        return response()->json([
            'mensaje'
            => 'No coinciden las contraseñas',

        ], 401);
    }
    $token = $user->createToken('autentificado')->plainTextToken;
    return response()->json([
        'access_token' => $token,
        /**(modo estándar de tokens HTTP) */
        'token_type' => 'Bearer',

        'user' => $user
    ]);
});


/*
En la siguiente ruta no estan protegidas porque aun no se registran 
*/
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/registroStore', [StoreController::class, 'registerStore']);

Route::options('/pdf-fichajes', function (Request $request) {
    return response('', 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// Route::post('/fichajes', [FichajeController::class, 'fichaje']);

/* apartir de aqui se protegen  */
// Route::middleware('auth:sanctum')->get('/mi-cuenta', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/fichajes', [FichajeController::class, 'fichaje']);
    Route::get('/pdf-fichajes', [FichajeController::class, 'descargarPDF']);
    Route::get('/mi-cuenta', function (Request $request) {
        return $request->user();
    });
});
