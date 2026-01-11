<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*$clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));*/

        $search = $request->input('search');
        $column = $request->input('column');
        $status = $request->input('status', 1);

        $clientes = \App\Models\Cliente::query();

        /*if ($search && $column !== null) {
            $clientes->where($column, 'like', '%' . $search . '%');
        }*/

        /* Filtro por estado SIEMPRE */
        if ($request->has('status')) {
            $clientes->where('estatus', $request->status);
        }

        /* Filtro de búsqueda SOLO si hay texto */
        if ($request->filled('search')) {
            $clientes->where(
                $request->column ?? 'nombre',
                'like',
                '%' . $request->search . '%'
            );
        }
        $clientes->orderBy('nombre','asc');

        $clientes = $clientes->paginate(10)->withQueryString();

        return view('cliente.index', compact('clientes', 'search', 'column', 'status'));
    }

    /**
     * Devuelve lista de clientes en JSON.
     */
    public function ListClients()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    /**
     * Devuelve un cliente por ID en JSON.
     */
    public function GetClient($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombre   = $request->input('nombre');
        $cliente->vigencia_plan   = $request->input('vigencia_plan');
        $cliente->fecha_nacimiento   = $request->input('nacimiento');
        $cliente->cedula   = $request->input('cedula');
        $cliente->celular = $request->input('celular');
        $cliente->eps   = $request->input('eps');
        $cliente->ocupacion   = $request->input('ocupacion');
        $cliente->correo   = $request->input('correo');
        $cliente->edad   = $request->input('edad');
        $cliente->rh   = $request->input('rh');
        $cliente->contact_emer   = $request->input('contact_emer');
        $cliente->num_contact_emer   = $request->input('num_contact_emer');
        $cliente->patologia   = $request->input('patologia');
        if($cliente->patologia == null){
            $cliente->patologia = "N/A";
        }
        $cliente->genero   = $request->input('genero');
        $cliente->estatura   = $request->input('estatura');
        $cliente->peso   = $request->input('peso');
        $cliente->fecha_ingreso   = $request->input('ingreso');
        /*$cliente->plan     = '16 clases';
        $cliente->clases   = '16';*/
        $cliente->plan   = 'N/A';
        $cliente->clases = 0;
        $cliente->estatus = 1;
        $cliente->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre   = $request->input('nombre');
        $cliente->vigencia_plan   = $request->input('vigencia_plan');
        $cliente->fecha_nacimiento   = $request->input('nacimiento');
        $cliente->cedula   = $request->input('cedula');
        $cliente->celular = $request->input('celular');
        $cliente->eps   = $request->input('eps');
        $cliente->ocupacion   = $request->input('ocupacion');
        $cliente->correo   = $request->input('correo');
        $cliente->edad   = $request->input('edad');
        $cliente->rh   = $request->input('rh');
        $cliente->contact_emer   = $request->input('contact_emer');
        $cliente->num_contact_emer   = $request->input('num_contact_emer');
        $cliente->patologia   = $request->input('patologia');
        if($cliente->patologia == null){
            $cliente->patologia = "N/A";
        }
        $cliente->genero   = $request->input('genero');
        $cliente->estatura   = $request->input('estatura');
        $cliente->peso   = $request->input('peso');
        $cliente->vigencia_plan   = $request->input('vigencia_plan');
        $cliente->estatus = $request->has('estatus') ? 1 : 0;
        $cliente->plan   = $request->filled('plan') ? $request->input('plan') : 'N/A';
        $cliente->clases = $request->filled('clases') ? $request->input('clases') : 'N/A';
        $cliente->estatus = 1;
        $cliente->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->back();
    }

    // Métodos adicionales para API
    public function GetClientData($code)
    {
        $client = Cliente::where('cedula', $code)->firstOrFail();
        return response()->json($client);
    }

    public function updateValue(Request $request, $code)
    {
        $client = Cliente::where('cedula', $code)->firstOrFail();
        $client->clases = $request->input('value');
        $client->save();
        return response()->json(['message' => 'Valor actualizado', 'new_value' => $client->clases]);
    }

            public function clientesPorVencer()
        {
            $clientes = DB::table('crudclientes.clientes')
                ->select('nombre', 'vigencia_plan')
                ->get()
                ->filter(function ($cliente) {
                    $hoy = \Carbon\Carbon::now();
                    $vigencia = \Carbon\Carbon::parse($cliente->vigencia_plan);

                    $dias = $hoy->diffInDays($vigencia, false);

                    return $dias >= 0 && $dias <= 5;
                })
                ->map(function ($cliente) {
                    $vigencia = \Carbon\Carbon::parse($cliente->vigencia_plan);
                    $hoy = \Carbon\Carbon::now();
                    $cliente->faltan_dias = $hoy->diffInDays($vigencia, false);
                    return $cliente;
                })
                ->values();

            return response()->json($clientes);
        }

}
