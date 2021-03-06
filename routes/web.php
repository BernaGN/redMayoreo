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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/data', [App\Http\Controllers\DataController::class, 'index'])->name('data');
Route::get('/form', [App\Http\Controllers\FormController::class, 'index'])->name('form');
Route::get('/avanced', [App\Http\Controllers\AvancedController::class, 'index'])->name('avanced');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
