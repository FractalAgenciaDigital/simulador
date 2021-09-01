<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\SedeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/clientes',  ClienteController::class);
Route::post('/clientes/{cliente}/camEstado',  [ClienteController::class, 'camEstado']);

// Route::resource('/usuarios',  UsuarioController::class);
Route::post('/usuarios/{usuario}/camEstado',  [UsuarioController::class, 'camEstado']);

// Route::resource('/creditos',  CreditoController::class);
Route::post('/creditos/{credito}/camEstado',  [CreditoController::class, 'camEstado']);

Route::post('/sedes/{sede}/camEstado',  [SedeController::class, 'camEstado']);

Route::post('/clientes/{cliente}/cambiar-estado',  [ClienteController::class, 'cambiarEstado']);

Route::resource('/usuarios',  UsuarioController::class);

