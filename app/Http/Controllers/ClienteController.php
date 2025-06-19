<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
        $cliente->telefono = $request->input('telefono');
        $cliente->correo   = $request->input('correo');
        $cliente->cedula   = $request->input('cedula');
        $cliente->plan     = '16 clases';
        $cliente->clases   = '16';
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
        $cliente->telefono = $request->input('telefono');
        $cliente->correo   = $request->input('correo');
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
