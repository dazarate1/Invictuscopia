<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pagos::all();
        return view('finanzas.pagos', compact('pagos'));
    }

    public function store(Request $request)
    {
        $pago = new Pagos;
        $pago->paydate = $request->input('paydate');
        $pago->nombre = $request->input('nombre');
        $pago->category = $request->input('category');
        $pago->plan = $request->input('plan');
        if($pago->plan == null){
            $pago->plan = "N/A";
        }
        $pago->monto = $request->input('monto');
        $pago->paymethod = $request->input('paymethod');

        $pago->save();
        
        $nuevo_plan = $request->input('plan');
        if ($nuevo_plan === "Mensual") {
            $actualizar_clases = "30";
        } else if ($nuevo_plan === "Semi 12") {
            $actualizar_clases = "12";
        }

        if ($pago->category === "Cliente") {
            $fechapago = Carbon::parse($request->input('paydate'));
            $vigencia_plan = $fechapago->addDays(30);
            \DB::table('clientes')->where('id', $request->input('cliente_id'))->update([
                'plan' => $pago->plan,
                'clases' => $actualizar_clases,
                'vigencia_plan' => $vigencia_plan,
            ]);
        }

        return redirect()->back();
    }

}
