<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // <-- importa DB
use Carbon\Carbon;

class DatosController extends Controller
{
    // ...

    // Muestra la página principal de "Datos"
    public function index()
    {
        // Trae el historial (ajusta columnas si tu vista necesita otras)
        $metricas = DB::table('metricsclients')
            ->orderByDesc('fecha_valoracion')
            ->get();

        // Si tu landing de Datos es datos/index.blade.php:
        return view('datos.index', compact('metricas'));

        // Si en tu proyecto usas otra vista para la tabla (por ejemplo):
        // return view('datos.historialmetrics', compact('metricas'));
        // return view('datos.client-metrics', compact('metricas'));
    }

    // (ejemplo del update que ya venimos usando)
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'client_id'           => 'required|integer',
        'fecha_valoracion'    => 'required|date',
        'peso'                => 'required|numeric',
        'imc'                 => 'required|numeric',
        'grasa_corporal'      => 'required|numeric',
        'lvl_agua'            => 'required|numeric',
        'grasa_visc'          => 'required|numeric',
        'musculo'             => 'required|numeric',
        'proteina'            => 'required|numeric',
        'metabolismo'         => 'required|numeric',
        'masa_osea'           => 'required|numeric',
    ]);

    // Normaliza fecha_valoracion (YYYY-MM-DD)
    $fechaVal = Carbon::parse($validated['fecha_valoracion'])->startOfDay();
    // Próxima valoración = misma fecha + 2 meses (sin desbordes)
    $fechaSig = $fechaVal->copy()->addMonthsNoOverflow(2);

    $payload = [
        'client_id'            => $validated['client_id'],
        'fecha_valoracion'     => $fechaVal->toDateString(),
        'fecha_sig_valoracion' => $fechaSig->toDateString(),
        'peso'                 => $validated['peso'],
        'imc'                  => $validated['imc'],
        'grasa_corporal'       => $validated['grasa_corporal'],
        'lvl_agua'             => $validated['lvl_agua'],
        'grasa_visc'           => $validated['grasa_visc'],
        'musculo'              => $validated['musculo'],
        'proteina'             => $validated['proteina'],
        'metabolismo'          => $validated['metabolismo'],
        'masa_osea'            => $validated['masa_osea'],
    ];

    // OJO: tu PK es "ID" (mayúscula)
    $updated = DB::table('metricsclients')
        ->where('ID', $id)
        ->update($payload);

    return back()->with(
        $updated ? 'success' : 'error',
        $updated ? 'Métrica actualizada correctamente.' : 'No se realizaron cambios.'
    );
}
}
