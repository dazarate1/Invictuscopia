<?php

namespace App\Http\Controllers;
use App\Models\cliente;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now();
        $sieteDias = $hoy->copy()->addDays(7);

        $clientes = Cliente::select('nombre', 'fecha_nacimiento')
        ->whereRaw("DATE_FORMAT(fecha_nacimiento, '%m-%d') >= ?", [$hoy->format('m-d')])
        ->whereRaw("DATE_FORMAT(fecha_nacimiento, '%m-%d') <= ?", [$sieteDias->format('m-d')])
        ->orderByRaw("DATE_FORMAT(fecha_nacimiento, '%m-%d') ASC")
        ->get();

        return view('dashboard', compact('clientes'));
    }
}
