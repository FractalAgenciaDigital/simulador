<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\CuotaController;
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
Route::post('/clientes/{cliente}/cambiar-estado',  [ClienteController::class, 'cambiarEstado']);
Route::get('/clientes/{cliente}/creditos', [ClienteController::class, 'creditos']);


Route::resource('/proveedores',  ProveedorController::class);
Route::post('/proveedores/{proveedor}/cambiar-estado',  [ProveedorController::class, 'cambiarEstado']);

// Route::resource('/pagos',  PagoController::class);
// Route::post('/pagos/{pago}/cambiar-estado',  [PagoController::class, 'cambiarEstado']);
Route::resource('/usuarios',  UsuarioController::class);
Route::post('/usuarios/{usuario}/cambiar-estado',  [UsuarioController::class, 'cambiarEstado']);

Route::resource('/sedes',  SedeController::class);
Route::post('/sedes/{sede}/cambiar-estado',  [SedeController::class, 'cambiarEstado']);

Route::resource('/creditos', CreditoController::class);
Route::post('/creditos/{credito}/cambiar-estado',  [CreditoController::class, 'cambiarEstado']);
Route::get('/creditos/{credito}/cuotas', [CreditoController::class, 'cuotas']);
Route::get('/cuotas/calcular-cuotas', [CuotaController::class, 'calcularCuotas']);

Route::resource('/cuotas', CuotaController::class);

