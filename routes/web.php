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
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;

Auth::routes(["register" => false]);

//Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

//Sistema
Route::resource('/usuarios', UsuarioController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('/roles', RolController::class)->only(['index', 'store', 'edit', 'update']);

//Catalogos
Route::resource('/proveedores', App\Http\Controllers\ProveedorController::class);

//Procesos

//Reportes
