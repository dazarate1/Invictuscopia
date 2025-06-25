<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\MetricsController;

// Página de login
Route::get('/', fn() => view('auth.login'));
Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cliente', function () {$clientes = App\Models\Cliente::all();return view('cliente.index', compact('clientes'));})->name('cliente.index');
Route::get('/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'GetClient'])->name('cliente.obtener');
Route::get('/datos', [App\Http\Controllers\DatosController::class, 'index'])->name('datos.index');
Route::resource('cliente', ClienteController::class);*/
// Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

// Ruta mixta para “/cliente”:
//  - Si es petición AJAX o JSON, devuelve la lista en JSON.
//  - Si es petición normal, carga la vista Blade con $clientes.
/*Route::get('/cliente', function (\Illuminate\Http\Request $request) {
    if ($request->ajax() || $request->wantsJson()) {
        return app(ClienteController::class)->ListClients();
    }
    $clientes = App\Models\Cliente::all();
    return view('cliente.index', compact('clientes'));
})->name('cliente.index');*/

Route::get('/cliente', function () {
    $clientes = App\Models\Cliente::all();
    return view('cliente.index', compact('clientes'));
})->name('cliente.index');

// Ruta para JS (API JSON)
Route::get('/api/cliente', [ClienteController::class, 'ListClients']);

// Obtener un cliente individual en JSON
Route::get('/cliente/{id}', [ClienteController::class, 'GetClient'])
    ->name('cliente.obtener');

// CRUD de clientes (form submissions)
Route::post('/cliente',            [ClienteController::class, 'store'])   ->name('cliente.store');
Route::put('/cliente/{id}',       [ClienteController::class, 'update'])  ->name('cliente.update');
Route::delete('/cliente/{id}',    [ClienteController::class, 'destroy']) ->name('cliente.destroy');

// Vista de Datos del Cliente
Route::get('/datos', [DatosController::class, 'index'])
    ->name('datos.index');

//Routa de almacenamiento de metricas
Route::post('/storemetrics', [MetricsController::class, 'store']);
Route::get('/cliente/{id}/metrics', [MetricsController::class, 'showHistory']);
