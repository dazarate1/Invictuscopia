<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\Pagos;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(){
        $hoy = Carbon::now();

        // Obtener todos los clientes
        $clientes = Cliente::all();

        // Filtrar y ordenar clientes con cumpleaños en los próximos 7 días
        $cumpleaneros = $clientes->filter(function ($cliente) use ($hoy) {
        $cumpleEsteAnio = Carbon::createFromDate(
                $hoy->year,
                date('m', strtotime($cliente->fecha_nacimiento)),
                date('d', strtotime($cliente->fecha_nacimiento))
            );
            if ($cumpleEsteAnio->lessThan($hoy)) {
                $cumpleEsteAnio->addYear();
            }
            return $hoy->diffInDays($cumpleEsteAnio) <= 7;
            })->sortBy(function ($cliente) use ($hoy) {
            $cumpleEsteAnio = Carbon::createFromDate(
                $hoy->year,
                date('m', strtotime($cliente->fecha_nacimiento)),
                date('d', strtotime($cliente->fecha_nacimiento))
            );
            if ($cumpleEsteAnio->lessThan($hoy)) {
                $cumpleEsteAnio->addYear();
            }
            return $hoy->diffInDays($cumpleEsteAnio);
         });

        $clientesConPocasClases = Cliente::where('clases', '<=', 5)->get();

        $pagosHoy = Pagos::whereDate('paydate', Carbon::today())->get();

        return view('home', [
            'cumpleaneros' => $cumpleaneros,
            'clientesConPocasClases' => $clientesConPocasClases,
            'pagosHoy' => $pagosHoy
        ]);
    }

}
