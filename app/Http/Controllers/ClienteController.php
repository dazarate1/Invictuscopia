<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));
        //
    }

    public function ListClients()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function GetClient($id){
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    // Obtener cliente por código
    public function GetClientData($code)
    {
        $client = cliente::where('cedula', $code)->first();
        
        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        return response()->json($client);
    }

    public function updateValue(Request $request, $code)
    {
        $client = cliente::where('cedula', $code)->first();

        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $client->clases = $request->input('value'); // Recibe el nuevo valor desde el frontend
        $client->save();

        return response()->json(['message' => 'Valor actualizado', 'new_value' => $client->clases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clientes = new Cliente;
        $clientes->nombre =  $request->input('nombre');
        $clientes->telefono = $request->input('telefono');
        $clientes->correo = $request->input('correo');
        $clientes->cedula = $request->input('cedula');
        $clientes->plan = '16 clases';
        $clientes->clases = '16';
        $clientes->save();
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clientes = Cliente::find($id);
        $clientes->nombre =  $request->input('nombre');
        $clientes->telefono = $request->input('telefono');
        $clientes->correo = $request->input('correo');
        $clientes->update();
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clientes = Cliente::find($id);
        $clientes->delete();
        return redirect()->back();
        //
    }
}
