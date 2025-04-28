<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    
    //return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'ListClients'])->name('cliente.list');
Route::get('/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'GetClient'])->name('cliente.obtener');
Route::get('/datos', [App\Http\Controllers\DatosController::class, 'index'])->name('datos.index');
Route::resource('home', ClienteController::class);