<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente; // Suponiendo que tienes un modelo Client con códigos de acceso

class AccessController extends Controller
{
    public function validateAccess(Request $request)
    {
        $code = $request->input('code');
        $client = cliente::where('cedula', $code)->first();

        if ($client) {
            return response()->json(['access' => true, 'message' => '✅ Acceso permitido']);
        } else {
            return response()->json(['access' => false, 'message' => '❌ Acceso denegado'], 403);
        }
    }
}

