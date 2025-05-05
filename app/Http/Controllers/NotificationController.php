<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public function successNotification(Request $request)
    {
        // Guardar los datos en cache por 5 segundos
        Cache::put('client_data', [
            'name' => $request->name,
            'email' => $request->email,
            'clases' => $request->clases
        ], now()->addSeconds(5));

        return response()->json(['message' => 'Notificación enviada']);
    }

    public function checkNotification()
    {
        $data = Cache::pull('client_data', null); // Obtener y eliminar la señal
        return response()->json(['client' => $data]);
    }
}
