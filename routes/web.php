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
Route::resource('/proveedores', ProveedorController::class)->except('create', 'show');
Route::resource('/clientes', ClienteController::class)->except('create', 'show');
Route::resource('/productos', ProductoController::class)->except('create', 'show');

//Procesos
Route::resource('/series', SerieController::class)->except('create', 'edit', 'update');

//Reportes
Route::get('/reporte-series-pdf/{id?}', [App\Http\Controllers\ReporteSerieController::class, 'pdf'])->name('reporte-series-pdf');
Route::get('exportar-proveedores', [ProveedorController::class, 'export'])->name('exportar-proveedores');
Route::get('exportar-clientes', [ClienteController::class, 'export'])->name('exportar-clientes');
Route::get('exportar-productos', [ProductoController::class, 'export'])->name('exportar-productos');

Route::post('importar-proveedores', [ProveedorController::class, 'import'])->name('importar-proveedores');
Route::post('importar-clientes', [ClienteController::class, 'import'])->name('importar-clientes');
Route::post('importar-productos', [ProductoController::class, 'import'])->name('importar-productos');
