@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<main class="main-content">
  <div class="dashboard-top">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <p>¡Administra tu gimnasio de forma sencilla!</p>
  </div>

  <div class="dashboard-container">
    <div class="dashboard-row">

      <!-- Cumpleaños -->
      <div class="card shadow-sm dashboard-card">
        <div class="card-body text-center">
          <h5 class="card-title">Próximos Cumpleaños</h5>
          @if($cumpleaneros->isEmpty())
            <p>No hay cumpleaños próximos en los próximos 7 días.</p>
          @else
            <ul class="list-unstyled mb-0">
              @foreach($cumpleaneros as $cliente)
                <li>{{ $cliente->nombre }} – {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m') }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>

      <!-- Clientes con ≤ 5 clases -->
      <div class="card shadow-sm dashboard-card">
        <div class="card-body text-center">
          <h5 class="card-title">Clientes con menos de 5 clases</h5>
          @if($clientesConPocasClases->isEmpty())
            <p>No hay clientes con menos de 5 clases.</p>
          @else
            <ul class="list-unstyled mb-0 text-start">
              @foreach ($clientesConPocasClases as $cliente)
                <li>{{ $cliente->nombre }} – {{ $cliente->clases }} clases</li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>

      <!-- Gráfico -->
      <div class="card shadow-sm dashboard-card">
        <div class="card-body text-center">
          <h5 class="card-title">Gráfico Provisional</h5>
          <div id="chartPlaceholder" style="height:200px; background:#e9ecef; border-radius:.25rem;"></div>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection
