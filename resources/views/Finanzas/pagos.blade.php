{{-- resources/views/finanzas/pagos.blade.php --}}
@extends('home')

@section('content')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
<style>
  /* Ajustes rápidos para los filtros */
  .payments-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.5rem;
    align-items: center;
  }
  .payments-actions .clients-filter,
  .payments-actions .clients-search {
    flex: 1;
    min-width: 150px;
  }
  .btn-new-payment {
    background: #f97316;
    color: #fff;
    border-radius: .5rem;
    padding: .5rem 1rem;
    border: none;
    flex: none;
  }
</style>

<div class="clients-container">
  <div class="clients-card">
    <header class="clients-header">
      <h1 class="clients-title">Historial de Transacciones</h1>
    </header>

    <div class="payments-actions">
      <input
        type="text"
        id="searchName"
        class="clients-search"
        placeholder="Buscar por nombre..."
      />
      <select id="filterCategory" class="clients-filter">
        <option value="">Todos los Tipos</option>
        <option value="Cliente">Cliente</option>
        <option value="Proteínas">Proteínas</option>
        <option value="Gastos">Gastos</option>
        <option value="Servicios">Servicios</option>
      </select>
      <select id="filterPlan" class="clients-filter">
        <option value="">Todos los Planes</option>
        <option value="Mensual">Mensual</option>
        <option value="Pareja">Pareja</option>
        <option value="Semi 12">Semi 12</option>
        <option value="Semi 16">Semi 16</option>
        <option value="Pro 12">Semi 12</option>
        <option value="Pro 16">Semi 16</option>
      </select>
      <select id="filterAmount" class="clients-filter">
        <option value="">Todos los Montos</option>
        <option value="1">Menos de 50 000</option>
        <option value="2">50 000 – 100 000</option>
        <option value="3">Más de 100 000</option>
      </select>
      <button class="btn-new-payment" data-bs-toggle="modal" data-bs-target="#createPagoModal">
        + Nuevo Pago
      </button>
    </div>

    <div class="table-responsive">
      <table class="clients-table" id="pagos-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Categoría</th>
            <th>Plan</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Monto</th>
            <!--<th>Hora</th>-->
            <th>Método</th>
            <!-- <th>Descripción</th>-->
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($pagos as $pago)
            <tr data-name="{{ $pago->nombre }}" data-category="{{ $pago->category }}" data-plan="{{ $pago->plan }}" data-amount="{{$pago->monto}}">
              @php
                $fecha = $pago->paydate;
                $soloFecha = date('d-m-Y', strtotime($fecha));

                $monto = $pago->monto;
                $format_monto = number_format($monto, 0, ',', '.');
              @endphp
              <td>{{ $soloFecha }}</td>
              <td>{{ $pago->nombre }}</td>
              <td>{{ $pago->category }}</td>
              <td>{{ $pago->plan }}</td>
              <td>
                @if(($pago->category === "Cliente") || ($pago->category === "Proteínas") )
                  {{ $format_monto }}
                @endif 
              </td>
              <td>
                @if(($pago->category === "Gastos") || ($pago->category === "Servicios") )
                  {{ $format_monto }}
                @endif
              </td>
              <!--<td>{{ $format_monto }}</td>-->
              <td>{{ $pago->paymethod }}</td>
              <!-- <td{{ $pago->description }}</td> -->
              <td class="actions-cell">
                  <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editpago{{ $pago->id }}">
                    Editar
                  </button>
                  <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deletepago{{ $pago->id }}">
                    Eliminar
                  </button>
                </td>
            </tr>
            @include('finanzas.info')
          @endforeach
        </tbody>
        <!--<tbody>
          <tr data-name="Carlos Gómez" data-category="Cliente" data-plan="Mensual" data-amount="80000">
            <td>2025-07-31</td>
            <td>Carlos Gómez</td>
            <td>Cliente</td>
            <td>Mensual</td>
            <td>$80.000</td>
            <td>08:15</td>
            <td>Efectivo</td>
          </tr>
          <tr data-name="Laura Méndez" data-category="Cliente" data-plan="Semanal" data-amount="25000">
            <td>2025-07-31</td>
            <td>Laura Méndez</td>
            <td>Cliente</td>
            <td>Semanal</td>
            <td>$25.000</td>
            <td>10:00</td>
            <td>Transferencia</td>
          </tr>
          <tr data-name="Compra Proteínas" data-category="Proteínas" data-plan="" data-amount="45000">
            <td>2025-07-31</td>
            <td>Compra Proteínas</td>
            <td>Proteínas</td>
            <td>—</td>
            <td>$45.000</td>
            <td>11:30</td>
            <td>Tarjeta</td>
          </tr>
          <tr data-name="Pago Servicios" data-category="Servicios" data-plan="" data-amount="120000">
            <td>2025-07-31</td>
            <td>Pago Servicios</td>
            <td>Servicios</td>
            <td>—</td>
            <td>$120.000</td>
            <td>12:45</td>
            <td>Transferencia</td>
          </tr>
        </tbody>-->
      </table>
    </div>
  </div>
</div>

<!-- Modal dummy de creación -->
@include('finanzas.create')

<script>
  const inputs = [
    'searchName','filterCategory',
    'filterPlan','filterAmount'
  ].map(id => document.getElementById(id));

  inputs.forEach(el => {
    el.addEventListener(el.tagName==='SELECT'?'change':'input', filterPayments);
  });

  function filterPayments() {
    const name = document.getElementById('searchName').value.toLowerCase();
    const cat  = document.getElementById('filterCategory').value;
    const plan = document.getElementById('filterPlan').value;
    const amt  = document.getElementById('filterAmount').value;

    document
      .querySelectorAll('#pagos-table tbody tr')
      .forEach(row => {
        let show = true;
        if(name && !row.dataset.name.toLowerCase().includes(name)) show = false;
        if(cat  && row.dataset.category      !== cat)  show = false;
        if(plan && row.dataset.plan          !== plan) show = false;
        if(amt) {
          const v = +row.dataset.amount;
          if(amt==='1' && v >= 50000)        show = false;
          if(amt==='2' && (v<50000||v>100000)) show = false;
          if(amt==='3' && v <= 100000)       show = false;
        }
        row.style.display = show ? '' : 'none';
      });
  }
</script>

@endsection
