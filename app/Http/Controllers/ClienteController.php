<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

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

    $clientes = \App\Models\Cliente::query();

    if ($search && $column !== null) {
        $clientes->where($column, 'like', '%' . $search . '%');
    }

    $clientes = $clientes->paginate(10)->withQueryString();

    return view('cliente.index', compact('clientes', 'search', 'column'));
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
        $cliente->plan   = $request->input('plan');
        $cliente->clases   = $request->input('clases');
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
}
