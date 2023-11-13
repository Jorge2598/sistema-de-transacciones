<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('tarjetas','App\Http\Controllers\TarjetaController');
Route::resource('registros','App\Http\Controllers\RegistroController');
Route::resource('cuenta','App\Http\Controllers\CuentaController');

Route::get('/', function () {
    return view('auth.login');});
    
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dash.index');})->name('dashboard');
});

