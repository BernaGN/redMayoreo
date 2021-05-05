<?php

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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ReporteSerieController;

Auth::routes(["register" => false]);

//Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

//Sistema
Route::get('/parametros', [ParametroController::class, 'index'])->name('parametros');
Route::resource('/usuarios', UsuarioController::class)->except('create', 'show');
Route::resource('/roles', RolController::class)->only(['index', 'store', 'edit', 'update']);

//Catalogos
Route::resource('/proveedores', App\Http\Controllers\ProveedorController::class)->except('create', 'show');
Route::resource('/clientes', App\Http\Controllers\ClienteController::class)->except('create', 'show');
Route::resource('/productos', App\Http\Controllers\ProductoController::class)->except('create', 'show');

//Procesos
Route::resource('/series', App\Http\Controllers\SerieController::class)->except('create', 'edit', 'update');

//Reportes
Route::get('/reporte-series-pdf/{id?}', [App\Http\Controllers\ReporteSerieController::class, 'pdf'])->name('reporte-series-pdf');
