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
      html, body { height: 100%; margin: 0; font-family: 'Poppins', sans-serif; }
      .app-layout { display: flex; min-height: 100vh; }
      .sidebar { width: 240px; background-color: #343a40; display: flex; flex-direction: column; padding-top: 1rem; }
      .sidebar a { color: #f8f9fa; text-decoration: none; padding: .75rem 1.25rem; font-weight: 500; border-left: 3px solid transparent; transition: background .2s, border-left-color .2s; }
      .sidebar a:hover { background-color: #495057; border-left-color: #f97316; }
      .sidebar a.active { background-color: #212529; border-left-color: #f97316; }
      .profile-section { margin-top: auto; border-top: 1px solid #495057; }
      .profile-section form button { display: block; padding: .75rem 1.25rem; color: #f8f9fa; background: none; border: none; text-align: left; width: 100%; }
      .profile-section form button:hover { background-color: #495057; }
      .main-content { flex: 1; background-color: #f8f9fa; padding: 2rem; }
      .module-section { background: #fff; border-left: 4px solid #f97316; border-radius: .5rem; padding: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; }
      .module-section h3 { margin-bottom: 1rem; color: #f97316; font-weight: 600; }
      .info-box { background: #fff; padding: 1rem; border-radius: .5rem; text-align: center; }
      .chart-container { width: 300px; height: 300px; margin: auto; }
      .chart-container canvas { max-width: 100%; max-height: 100%; }
    </style>

  <div class="dashboard-top">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <p>¡Administra tu gimnasio de forma sencilla!</p>
  </div>

  <div class="dashboard-container">
    <div class="dashboard-row">
            @if(request()->is('home'))
        <div class="container">
                  <!-- Resumen del Día & Próximos Cumpleaños -->
                  <div class="row gy-4 justify-content-center">
                    <div class="col-md-6">
                      <section class="module-section">
          <h3>🧾 Resumen del Día</h3>
          <div class="info-box text-center">
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

      <!-- Cumpleaños -->
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
                      $nacimiento = \Carbon\Carbon::parse($cliente->fecha_nacimiento);
                      $cumpleEsteAnio = \Carbon\Carbon::create($hoy->year, $nacimiento->month, $nacimiento->day)->startOfDay();

                      if ($cumpleEsteAnio->lessThan($hoy)) {
                          $cumpleEsteAnio->addYear();
                      }

                      $diasFaltantes = $hoy->diffInDays($cumpleEsteAnio); // Ya será un entero
                      $edad = $nacimiento->age + 1;

                      if ($diasFaltantes === 0) {
                          $enTexto = "hoy";
                      } elseif ($diasFaltantes === 1) {
                          $enTexto = "mañana";
                      } else {
                          $enTexto = "en {$diasFaltantes} días";
                      }
                  @endphp

                  <li><strong>{{ $cliente->nombre }} </strong> – {{ $enTexto }} (cumple {{ $edad }})</li>
              @endforeach

              @endif
            </ul>
          </div>
        </section>
      </div>

      <div class="row gy-4 justify-content-center">
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
        <div class="col-md-6">
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

      <!-- Sugerencias Seguimiento -->
          <div class="row gy-4 justify-content-center">
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
            </div>
          </div>
        </div>

      @endif

    </div>
  </div>
</main>
@endsection


