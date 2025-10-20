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
        $validatedData = $request->validate([
            'fecha_valoracion'     => 'nullable|date',
            'fecha_sig_valoracion' => 'nullable|date',
            'client_id'            => 'nullable|integer',
            'score_corporal'       => 'nullable|numeric',
            'peso'                 => 'nullable|numeric',
            'imc'                  => 'nullable|numeric',
            'grasa_corporal'       => 'nullable|numeric',
            'lvl_agua'             => 'nullable|numeric',
            'grasa_visc'           => 'nullable|numeric',
            'musculo'              => 'nullable|numeric',
            'proteina'             => 'nullable|numeric',
            'metabolismo'          => 'nullable|numeric',
            'masa_osea'            => 'nullable|numeric',
        ]);

        if (!empty($validatedData['fecha_valoracion'])) {
            $validatedData['fecha_valoracion'] = Carbon::parse($validatedData['fecha_valoracion'])->format('Y-m-d');
        }
        if (!empty($validatedData['fecha_sig_valoracion'])) {
            $validatedData['fecha_sig_valoracion'] = Carbon::parse($validatedData['fecha_sig_valoracion'])->format('Y-m-d');
        }

        $updated = DB::table('metricsclients')
            ->where('ID', $id)  // usa 'ID' si tu PK está en mayúscula
            ->update($validatedData);

        return back()->with($updated ? 'success' : 'error',
            $updated ? 'Métrica actualizada correctamente.' : 'No se pudo actualizar o no hubo cambios.'
        );
    }
}
