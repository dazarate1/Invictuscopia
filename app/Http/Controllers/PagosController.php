<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;

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
        $pago->monto = $request->input('monto');
        $pago->paymethod = $request->input('paymethod');

        $pago->save();

        return redirect()->back();
    }

}
