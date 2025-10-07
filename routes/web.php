<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\PagosController;


// Página de login
Route::get('/', fn() => view('auth.login'));
Auth::routes();

Route::middleware(['auth'])->group(function(){
    
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

/*Route::get('/cliente', function () {
    $clientes = App\Models\Cliente::all();
    return view('cliente.index', compact('clientes'));
})->name('cliente.index');*/ 

Route::get('/cliente', [ClienteController::class, 'index'])->name('clientes.index');

// Ruta para JS (API JSON)
Route::get('/api/cliente', [ClienteController::class, 'ListClients']);

// Obtener un cliente individual en JSON
Route::get('/cliente/{id}', [ClienteController::class, 'GetClient'])
    ->name('cliente.obtener');

// CRUD de clientes (form submissions)
Route::post('/cliente',  [ClienteController::class, 'store'])   ->name('cliente.store');
Route::put('/cliente/{id}',       [ClienteController::class, 'update'])  ->name('cliente.update');
Route::delete('/cliente/{id}',    [ClienteController::class, 'destroy']) ->name('cliente.destroy');

// Vista de Datos del Cliente
Route::get('/datos', [DatosController::class, 'index'])
    ->name('datos.index');

//Routa de almacenamiento de metricas
Route::post('/storemetrics', [MetricsController::class, 'store']);
Route::get('/cliente/{id}/metrics', [MetricsController::class, 'showHistory']);

Route::get('/pagos', function () {
    $pagos = App\Models\Pagos::all();
    return view('finanzas.pagos', compact('pagos'));
})->name('pagos.index');

Route::post('/pagos', [PagosController::class, 'store']) ->name('pago.store');
Route::put('/pagos/{id}',       [PagosController::class, 'update'])  ->name('pago.update');
Route::delete('/pagos/{id}',    [PagosController::class, 'destroy']) ->name('pago.destroy');
Route::get('/pagos/{id}', [ClienteController::class, 'GetPay'])
    ->name('pago.obtener');
// Vista de Finanzas
/*Route::get('/pagos', function() {
    return view('finanzas.pagos');
})->name('pagos');*/

});

