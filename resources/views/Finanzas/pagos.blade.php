{{-- resources/views/finanzas/pagos.blade.php --}}
@extends('layouts.app')

@section('content')
  <style>
    .clients-container { display: flex; padding: 4rem 34rem; background: white; }
    .clients-card { max-width: 800px; margin: 0 auto; box-shadow: 0 4px 15px rgba(249,115,22,0.6); background: #fff; padding: 2rem; border-radius: 1rem; }
    .clients-title { color: #1f2937; text-align: center; font-size: 1.75rem; font-weight: 700; margin-bottom: 1.5rem; }
    .actions-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    #filtroNombre { flex: 1; margin-right: 1rem; padding: .5rem 1rem; border: 1px solid #f97316; border-radius: .5rem; background: #fff7f0; }
    .btn-new-payment { background: #f97316; color: #fff; padding: .5rem 1rem; border:none; border-radius:.5rem; }
    .btn-new-payment:hover { background:#ea580c; }
    #tablaPagos { width:100%; border-collapse:collapse; }
    #tablaPagos th, #tablaPagos td { border:1px solid #e5e7eb; padding:.75rem; text-align:center; }
    #tablaPagos thead { background:#f97316; color:#fff; }
    #tablaPagos tbody tr:nth-child(even) { background:#f9fafb; }
    #tablaPagos tbody tr:hover { background:#fde8cf; }
    .modal-content.clients-card { padding:1.5rem; max-width: 500px; margin: auto; }
    .modal-header .clients-title { margin:0; text-align: center; width: 100%; }
    .modal-body { display: flex; flex-direction: column; align-items: center; }
    .modal-body .form-group { margin-bottom:1rem; width: 100%; max-width: 360px; }
    .modal-body .clients-input, .modal-body .clients-filter { width:100%; padding:.5rem 1rem; border:1px solid #f97316; border-radius:.5rem; background:#fff7f0; }
  </style>

  @php
    $pagosDelDia = [
      ['nombre'=>'Carlos Gómez','plan'=>'Mensual','monto'=>'$80.000','hora'=>'08:15','metodo'=>'Efectivo'],
      ['nombre'=>'Laura Méndez','plan'=>'Semanal','monto'=>'$25.000','hora'=>'10:00','metodo'=>'Transferencia'],
      ['nombre'=>'Andrés Peña','plan'=>'Mensual','monto'=>'$80.000','hora'=>'12:20','metodo'=>'Nequi'],
    ];
  @endphp

  <div class="clients-container">
    <div class="clients-card">
      <h2 class="clients-title">Pagos del Día </h2>

      <div class="actions-bar">
        <input type="text" id="filtroNombre" placeholder="Buscar por nombre...">
        <button type="button" class="btn-new-payment" data-bs-toggle="modal" data-bs-target="#dummyPagoModal">
          + Nuevo Pago
        </button>
      </div>

      <div class="table-responsive">
        <table id="tablaPagos">
          <thead>
            <tr>
              <th>Nombre</th><th>Plan</th><th>Monto</th><th>Hora</th><th>Método</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pagosDelDia as $p)
              <tr>
                <td>{{ $p['nombre'] }}</td>
                <td>{{ $p['plan'] }}</td>
                <td>{{ $p['monto'] }}</td>
                <td>{{ $p['hora'] }}</td>
                <td>{{ $p['metodo'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Dummy Pago -->
  <div class="modal fade" id="dummyPagoModal" tabindex="-1" aria-labelledby="dummyPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content clients-card">
        <div class="modal-header">
          <h5 class="clients-title" id="dummyPagoLabel">Agregar Pago </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="clients-input" placeholder="Nombre del cliente">
          </div>
          <div class="form-group">
            <label>Plan</label>
            <input type="text" class="clients-input" placeholder="Plan">
          </div>
          <div class="form-group">
            <label>Monto</label>
            <input type="text" class="clients-input" placeholder="Monto">
          </div>
          <div class="form-group">
            <label>Método</label>
            <select class="clients-filter">
              <option>Efectivo</option>
              <option>Transferencia</option>
              <option>Nequi</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-new-payment" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('filtroNombre').addEventListener('keyup', function(){
      const val = this.value.toLowerCase();
      document.querySelectorAll('#tablaPagos tbody tr').forEach(tr=>{
        tr.style.display = tr.children[0].textContent.toLowerCase().includes(val) ? '' : 'none';
      });
    });
  </script>
@endsection
