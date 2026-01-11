<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Metrics;

class MetricsController extends Controller
{
    public function store(Request $request)
    {
        try {
            $metrics = new Metrics;
            $metrics->client_id                 = $request->input('client_id');
            $metrics->fecha_valoracion          = $request->input('fecha_valoracion');

            $fecha_origial = $request->input('fecha_valoracion');
            $metrics->fecha_sig_valoracion      = Carbon::parse($fecha_origial)->addMonths(2);
            $metrics->score_corporal            = $request->input('score_corporal');
            $metrics->peso                      = $request->input('peso');
            $metrics->imc                       = $request->input('imc');
            $metrics->grasa_corporal            = $request->input('grasa_corporal');
            $metrics->lvl_agua                  = $request->input('lvl_agua');
            $metrics->grasa_visc                = $request->input('grasa_visc');
            $metrics->musculo                   = $request->input('musculo');
            $metrics->proteina                  = $request->input('proteina');
            $metrics->metabolismo               = $request->input('metabolismo');
            $metrics->masa_osea                 = $request->input('masa_osea');
            $metrics->save();

        //return redirect()->back()->with('mensaje', 'Métricas guardadas correctamente');
         return response()->json(['success' => true, 'mensaje' => 'Métricas guardadas']);
        }catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    public function showHistory($id)
    {
        $metricas = \App\Models\Metrics::where('client_id', $id)
            ->orderBy('id')
            ->get();

        return view('datos.historialmetrics', compact('metricas'));
    }

    public function update(Request $request, $id){
        $metrics = Metrics::findOrFail($id);
        $metrics->client_id                 = $request->input('cliente_id');
        $metrics->fecha_valoracion          = $request->input('fecha_valoracion');

        $fecha_origial = $request->input('fecha_valoracion');
        $metrics->fecha_sig_valoracion      = Carbon::parse($fecha_origial)->addMonths(2);
        //$metrics->score_corporal            = $request->input('score_corporal');
        $metrics->peso                      = $request->input('peso');
        $metrics->imc                       = $request->input('imc');
        $metrics->grasa_corporal            = $request->input('grasa_corporal');
        $metrics->lvl_agua                  = $request->input('lvl_agua');
        $metrics->grasa_visc                = $request->input('grasa_visc');
        $metrics->musculo                   = $request->input('musculo');
        $metrics->proteina                  = $request->input('proteina');
        $metrics->metabolismo               = $request->input('metabolismo');
        $metrics->masa_osea                 = $request->input('masa_osea');

        $metrics->save();

        return redirect()->back();

    }

    public function destroy($id)
    {
        $metrics = Metrics::findOrFail($id);
        $metrics->delete();

        return redirect()->back();
    }

}
