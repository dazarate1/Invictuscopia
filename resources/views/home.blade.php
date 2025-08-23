@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<main class="main-content">
  <style>
    :root {
      --chart-color-1: #ff9f40;
      --chart-color-2: #ffc107;
      --chart-color-3: #ff7f50;
    }
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }
    .app-layout { display: flex; min-height: 100vh; }
    .main-content {
      flex: 1;
      background-color: #f8f9fa;
      padding: 2rem;
    }
    .sidebar {
      width: 240px;
      background-color: #343a40;
      display: flex;
      flex-direction: column;
      padding-top: 1rem;
    }
    .sidebar a {
      color: #f8f9fa;
      text-decoration: none;
      padding: .75rem 1.25rem;
      font-weight: 500;
      border-left: 3px solid transparent;
      transition: background .2s, border-left-color .2s;
    }
    .sidebar a:hover { background-color: #495057; border-left-color: #f97316; }
    .sidebar a.active { background-color: #212529; border-left-color: #f97316; }
    .profile-section {
      margin-top: auto;
      border-top: 1px solid #495057;
    }
    .profile-section form button {
      display: block;
      width: 100%;
      text-align: left;
      padding: .75rem 1.25rem;
      color: #f8f9fa;
      background: none;
      border: none;
      transition: background .2s;
    }
    .profile-section form button:hover { background-color: #495057; }
    .module-section {
      background: #fff;
      border-left: 4px solid #f97316;
      border-radius: .5rem;
      padding: 1rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
      height: 100%;
    }
    .module-section h3 {
      margin-bottom: 1rem;
      color: #f97316;
      font-weight: 600;
    }
    .info-box {
      background: #fff;
      padding: 1rem;
      border-radius: .5rem;
      text-align: center;
    }
    .chart-container {
      width: 300px;
      height: 300px;
      margin: auto;
    }
    .chart-container canvas {
      max-width: 100%;
      max-height: 100%;
    }
    .payments-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }
    .payments-table th,
    .payments-table td {
      border: 1px solid #e5e7eb;
      padding: .75rem;
      text-align: center;
    }
    .payments-table thead {
      background: #f97316;
      color: #fff;
    }
    .payments-table tbody tr:nth-child(even) {
      background: #f9fafb;
    }
  </style>

  <div class="dashboard-top text-center mb-4">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <p>¡Administra tu gimnasio de forma sencilla!</p>
  </div>

  @if(request()->is('home'))
    <div class="container">
      <div class="row gy-4">
        <!-- 1st pair: Resumen & Pagos -->
        <div class="col-md-6">
          <section class="module-section">
            <h3>🧾 Resumen del Día</h3>
            <div class="info-box">
              <div class="chart-container">
                <canvas id="resumenChart"></canvas>
              </div>
            </div>
          </section>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById('resumenChart').getContext('2d');
          new Chart(ctx, {
            type: 'pie',
            data: {
              labels: ['Asistencias', 'Nuevos registros', 'Promedio'],
              datasets: [{
                data: [12, 3, 10],
                backgroundColor: ['#ff9f40', '#ffc107', '#ff7f50'],
              }]
            },
            options: {
              plugins: {
                legend: { position: 'bottom', labels: { color: '#1f2937' } }
              }
            }
          });
        </script>
        </div>
        <div class="col-md-6">
          <section class="module-section">
            <h3>💰 Pagos del Día</h3>
            <div class="table-responsive">
              <table class="payments-table">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Plan</th>
                    <th>Monto</th>
                    <!--<th>Hora</th>-->
                    <th>Método</th>
                  </tr>
                </thead>
                <tbody>
                  @if($pagosHoy->isEmpty())
                    <tr><strong>No hay pagos para el dia de hoy</strong></tr>
                  @else
                    @foreach($pagosHoy as $pagos)
                     @php
                      $fecha = $pagos->paydate;
                      $soloFecha = date('d-m-Y', strtotime($fecha));
                      $monto = $pagos->monto;
                      $format_monto = number_format($monto, 0, ',', '.');
                    @endphp
                      <tr>
                        <td>{{$soloFecha}}</td>
                        <td>{{$pagos->nombre}}</td>
                        <td>{{$pagos->category}}</td>
                        <td>{{$pagos->plan}}</td>
                        <td>{{$format_monto}}</td>
                        <td>{{$pagos->paymethod}}</td>
                      </tr>
                    @endforeach
                  @endif
                  <!--<tr>
                    <td>2025-07-31</td><td>Carlos Gómez</td><td>Cliente</td>
                    <td>Mensual</td><td>$80.000</td><td>08:15</td><td>Efectivo</td>
                  </tr>
                  <tr>
                    <td>2025-07-31</td><td>Laura Méndez</td><td>Cliente</td>
                    <td>Semanal</td><td>$25.000</td><td>10:00</td><td>Transferencia</td>
                  </tr>
                  <tr>
                    <td>2025-07-31</td><td>Compra Proteínas</td><td>Proteínas</td>
                    <td>—</td><td>$45.000</td><td>11:30</td><td>Tarjeta</td>
                  </tr>
                  <tr>
                    <td>2025-07-31</td><td>Pago Servicios</td><td>Servicios</td>
                    <td>—</td><td>$120.000</td><td>12:45</td><td>Transferencia</td>
                  </tr>-->
                </tbody>
              </table>
            </div>
          </section>
        </div>

        <!-- 2nd pair: Cumpleaños & Clientes Inactivos -->
        <div class="col-md-6">
          <section class="module-section">
            <h3>🎂 Próximos Cumpleaños</h3>
            <div class="info-box">
              <ul class="list-unstyled mb-0">
                @if($cumpleaneros->isEmpty())
                  <li><strong>No hay cumpleaños próximos en los próximos 7 días.</strong></li>
                @else
                  @foreach($cumpleaneros as $cliente)
                    @php
                      $hoy = \Carbon\Carbon::now()->startOfDay();
                      $nac = \Carbon\Carbon::parse($cliente->fecha_nacimiento);
                      $cum = \Carbon\Carbon::create($hoy->year,$nac->month,$nac->day)->startOfDay();
                      if($cum->lessThan($hoy)) $cum->addYear();
                      $dias = $hoy->diffInDays($cum);
                      $edad = $nac->age + 1;
                      $texto = $dias===0?'hoy':($dias===1?'mañana':"en {$dias} días");
                    @endphp
                    <li><strong>{{ $cliente->nombre }}</strong> – {{ $texto }} (cumple {{ $edad }})</li>
                  @endforeach
                @endif
              </ul>
            </div>
          </section>
        </div>
        <div class="col-md-6">
          <section class="module-section">
            <h3>📉 Clientes Inactivos</h3>
            <div class="info-box">
              <ul class="list-unstyled mb-0">
                <li>Laura Gómez – inactiva 15 días</li>
                <li>Pedro Martínez – inactivo 20 días</li>
                <li>Sofía Díaz – inactiva 30 días</li>
              </ul>
            </div>
          </section>
        </div>

        <!-- 3rd pair: Progreso Físico & Sugerencias -->
       <!-- <div class="col-md-6">
          <section class="module-section">
            <h3>📊 Progreso Físico Destacado</h3>
            <div class="info-box">
              <ul class="list-unstyled mb-0">
                <li>Andrés Ramírez – bajó <strong>5kg</strong> este mes</li>
                <li>Valeria Torres – cerca de peso ideal</li>
                <li>Jorge Molina – +2kg de músculo</li>
              </ul>
            </div>
          </section>
        </div>
        <div class="col-md-6">
          <section class="module-section">
            <h3>💬 Sugerencias de Seguimiento</h3>
            <div class="info-box">
              <ul class="list-unstyled mb-0">
                <li>Ana Pérez – solo 2/16 días asistidos</li>
                <li>Luis Fernández – 3/16 días asistidos</li>
                <li>Camila Rojas – 1/16 días asistidos</li>
              </ul>
            </div>
          </section>
        </div>--->
      </div>
    </div>
  @endif

</main>
@endsection
