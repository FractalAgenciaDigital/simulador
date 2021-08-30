<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// para trabajar con los recursos de api : edit y create se van, bye
Route::apiResource('/usuarios', UsuarioController::class);

// Route::resource('/usuarios',  UsuarioController::class);
// Route::post('/usuarios/{usuario}/camEstado',  [UsuarioController::class, 'camEstado']);
