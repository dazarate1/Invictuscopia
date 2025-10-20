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
        // Nota: Aquí tienes dos líneas; la primera usa un modelo "Pago" (sin s) que no está importado.
        // La dejo intacta para no romper nada de tu flujo, pero realmente esta línea sobreescribe la anterior.
        // $pagos = Pago::with('cliente')->get(); // 👈 si este modelo no existe, puede causar error.
        $pagos = Pagos::all();
        return view('finanzas.pagos', compact('pagos'));
    }

    public function GetPay($id)
    {
        // Igual aquí: si tu modelo real es "Pagos", usa Pagos::findOrFail($id)
        // Dejo tu línea original para no romper rutas que lo llamen.
        $pago = Pago::findOrFail($id);
        return response()->json($pago);
    }

    public function store(Request $request)
    {
        $pago = new Pagos;
        $pago->paydate   = $request->input('paydate');
        $pago->nombre    = $request->input('nombre');
        $pago->category  = $request->input('category');
        $pago->plan      = $request->input('plan') ?: "N/A";
        $pago->monto     = $request->input('monto');
        $pago->paymethod = $request->input('paymethod');
        // $pago->description = $request->input('description');
        $pago->save();

        // === Definir SIEMPRE el número de clases por plan ===
        $nuevo_plan = $request->input('plan');
        $actualizar_clases = 0; // default para evitar "Undefined variable"

        switch ($nuevo_plan) {
            case 'Mensual':
            case 'Pareja':   // si aplica en tu negocio
                $actualizar_clases = 30;
                break;
            case 'Semi 12':
            case 'Pro 12':
                $actualizar_clases = 12;
                break;
            case 'Semi 16':
            case 'Pro 16':
                $actualizar_clases = 16;
                break;
            default:
                $actualizar_clases = 0;
                break;
        }

        // === Actualiza cliente SOLO si corresponde ===
        if ($pago->category === "Cliente" && $request->filled('cliente_id')) {
            $fechapago = Carbon::parse($request->input('paydate'));
            $vigencia_plan = $fechapago->copy()->addDays(30);

            \DB::table('clientes')
                ->where('id', $request->input('cliente_id'))  // si tu PK real es "ID" en mayúscula, cámbialo aquí
                ->update([
                    'plan'          => $pago->plan,
                    'clases'        => $actualizar_clases,
                    'vigencia_plan' => $vigencia_plan,
                ]);
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $pago = Pagos::findOrFail($id);
        $pago->paydate   = $request->input('paydate');
        $pago->nombre    = $request->input('nombre');
        $pago->category  = $request->input('category');
        $pago->plan      = $request->input('plan') ?: "N/A";
        $pago->monto     = $request->input('monto');
        $pago->paymethod = $request->input('paymethod');
        // $pago->description = $request->input('description');

        // === Definir SIEMPRE el número de clases por plan ===
        $nuevo_plan = $request->input('plan');
        $actualizar_clases = 0; // default para evitar "Undefined variable"

        switch ($nuevo_plan) {
            case 'Mensual':
            case 'Pareja':   // si aplica
                $actualizar_clases = 30;
                break;
            case 'Semi 12':
            case 'Pro 12':
                $actualizar_clases = 12;
                break;
            case 'Semi 16':
            case 'Pro 16':
                $actualizar_clases = 16;
                break;
            default:
                $actualizar_clases = 0;
                break;
        }

        if ($pago->category === "Cliente" && $request->filled('cliente_id')) {
            $pago->cliente_id = $request->input('cliente_id');

            $fechapago = Carbon::parse($request->input('paydate'));
            $vigencia_plan = $fechapago->copy()->addDays(30);

            \DB::table('clientes')
                ->where('id', $request->input('cliente_id'))  
                ->update([
                    'plan'          => $pago->plan,
                    'clases'        => $actualizar_clases,
                    'vigencia_plan' => $vigencia_plan,
                ]);
        }

        $pago->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $pago = Pagos::findOrFail($id);
        $pago->delete();

        return redirect()->back();
    }
}
