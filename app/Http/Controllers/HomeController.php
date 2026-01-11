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

        $clientesConPocasClases = Cliente::where('clases', '<=', 3)->get();

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

        public function proximosValoracion()
    {
        $hoy    = Carbon::today();              // 00:00 de hoy
        $limite = Carbon::today()->addDays(5);  // +5 días

        // Si usas esquema, cámbialo a 'crudclientes.clientes as c'
        $rows = DB::table('metricsclients as m')
            ->join('clientes as c', 'c.ID', '=', 'm.client_id')   // PK en mayúscula
            ->whereBetween('m.fecha_sig_valoracion', [
                $hoy->toDateString(),
                $limite->toDateString()
            ])
            ->orderBy('m.fecha_sig_valoracion')
            ->select([
                'c.nombre',
                'm.fecha_sig_valoracion',
            ])
            ->get();

        $data = $rows->map(function ($r) use ($hoy) {
            $fecha = Carbon::parse($r->fecha_sig_valoracion);
            return [
                'nombre'               => $r->nombre,
                'fecha_sig_valoracion' => $fecha->toDateString(),
                'faltan_dias'          => max(0, $hoy->diffInDays($fecha)), // nunca negativo
            ];
        });

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

}
