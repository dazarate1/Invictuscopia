<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NotificationController;

// Validar acceso
Route::post('/validate-access', [AccessController::class, 'validateAccess']);

// Obtener datos del cliente
Route::get('/client/{cedula}', [ClienteController::class, 'GetClientData']);

// Actualizar valor del cliente
Route::put('/client/{cedula}', [ClienteController::class, 'updateValue']);

Route::post('/success-notification', [NotificationController::class, 'successNotification']);
Route::get('/check-notification', [NotificationController::class, 'checkNotification']);
