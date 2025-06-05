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
Route::get('/cliente', function () {$clientes = App\Models\Cliente::all();return view('cliente.index', compact('clientes'));})->name('cliente.index');
Route::get('/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'GetClient'])->name('cliente.obtener');
Route::get('/datos', [App\Http\Controllers\DatosController::class, 'index'])->name('datos.index');
Route::resource('home', ClienteController::class);