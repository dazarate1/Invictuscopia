<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
    public function clientesPorVencer()
    {
        $hoy = Carbon::now();

        $clientes = DB::table('crudclientes.clientes')
            ->select('nombre', 'vigencia_plan')
            ->get()
            ->filter(function ($cliente) use ($hoy) {
                $vigencia = Carbon::parse($cliente->vigencia_plan);
                $dias = $hoy->diffInDays($vigencia, false);
                return $dias >= 0 && $dias <= 5;
            })
            ->map(function ($cliente) use ($hoy) {
                $vigencia = Carbon::parse($cliente->vigencia_plan);
                $cliente->faltan_dias = $hoy->diffInDays($vigencia, false);
                return $cliente;
            })
            ->values();

        return response()->json($clientes);
    }

        public function clientesPorValorar()
    {
        $hoy = Carbon::now();
        $limite = $hoy->copy()->addDays(5);

        $resultados = DB::table('metricsclients')
            ->join('clientes', 'metricsclients.client_id', '=', 'clientes.id')
            ->select('clientes.nombre', 'metricsclients.fecha_sig_valoracion')
            ->whereDate('metricsclients.fecha_sig_valoracion', '>=', $hoy->toDateString())
            ->whereDate('metricsclients.fecha_sig_valoracion', '<=', $limite->toDateString())
            ->get();

        $clientes = DB::table('metricsclients')
    ->join('clientes', 'metricsclients.client_id', '=', 'clientes.id')
    ->select('clientes.nombre', 'metricsclients.fecha_sig_valoracion')
    ->whereNotNull('metricsclients.fecha_sig_valoracion')
    ->get()
    ->filter(function ($cliente) {
        $fechaHoy = Carbon::today();
        $fechaValoracion = Carbon::parse($cliente->fecha_sig_valoracion);
        $diasFaltantes = $fechaHoy->diffInDays($fechaValoracion, false);
        return $diasFaltantes >= 0 && $diasFaltantes <= 5;
    })
    ->map(function ($cliente) {
        $fechaValoracion = Carbon::parse($cliente->fecha_sig_valoracion);
        $dias = Carbon::today()->diffInDays($fechaValoracion, false);

        return (object) [
            'nombre' => $cliente->nombre,
            'fecha_valoracion' => $fechaValoracion->format('Y-m-d'),
            'faltan_dias' => $dias,
        ];
    });

        return response()->json($clientes);
    }

}
