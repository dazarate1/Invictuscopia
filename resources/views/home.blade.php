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
    <div class="row mb-4">
      <div class="col-md-6">
    <section class="module-section">
    <h3>📅 Planes por vencer en 5 días</h3>
    <div class="info-box">
      <ul class="list-unstyled mb-0" id="clientesPorVencer">
        <li>Cargando...</li>
      </ul>
    </div>
  </section>
</div> 

<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetch('/home/clientes-por-vencer', {
      credentials: 'same-origin',
      headers: {
        'Accept': 'application/json'
      }
    })
    .then(res => res.json())
    .then(data => {
  const list = document.getElementById('clientesPorVencer');
  list.innerHTML = '';

  if (data.length === 0) {
    list.innerHTML = '<li><strong>No hay usuarios próximos a vencer.</strong></li>';
    return;
  }

  data.forEach(cliente => {
    if (!cliente.vigencia_plan) return;

    const fecha = new Date(cliente.vigencia_plan);
    if (isNaN(fecha.getTime())) return; // Fecha inválida

    const fechaFormateada = fecha.toLocaleDateString('es-CO');
    const dias = parseInt(cliente.faltan_dias);

    let color = '';
    if (dias <= 2) {
      color = 'red';
    } else if (dias <= 5) {
      color = 'orange';
    }

    list.innerHTML += `
      <li style="color: ${color}">
        <strong>${cliente.nombre}</strong> – vence en ${dias} día${dias > 1 ? 's' : ''} (${fechaFormateada})
      </li>
    `;
  });
  })
    .catch(err => {
      document.getElementById('clientesPorVencer').innerHTML = '<li><strong>Error al cargar datos.</strong></li>';
    });
  });
</script>

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
      </div>

        <!-- 2nd pair: Cumpleaños & Clientes Inactivos -->
        <div class="row mb-4">
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
                      /*if ($dias == '0' ) {
                        $texto = 'hoy';
                      }elseif ($dias == '1' ) {
                        $texto = 'mañana';
                      } else {
                        $texto = "en {$dias} dias";
                      }*/
                      $texto = $dias == '0' ? 'hoy':($dias == '1' ? 'mañana':"en {$dias} días");
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
  <h3>📝 Próximos a valoración (≤5 días)</h3>
  <div class="info-box">
    <ul class="list-unstyled mb-0" id="proxValoracionList">
      <li>Cargando...</li>
    </ul>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  const list = document.getElementById('proxValoracionList');
  const URL_PROX = "{{ url('home/proximos-valoracion') }}"; // 🔒 absoluta

  try {
    const res = await fetch(URL_PROX, {
      credentials: 'same-origin',
      headers: { 'Accept': 'application/json' }
    });

    // Lee cuerpo SIEMPRE (para poder loguearlo si hay error/HTML)
    const raw = await res.text();
    const ct = res.headers.get('content-type') || '';

    if (!res.ok) {
      console.error('HTTP error:', res.status, raw.slice(0, 500));
      throw new Error(`HTTP ${res.status}`);
    }

    if (!ct.includes('application/json')) {
      console.error('Respuesta NO JSON. Content-Type:', ct, 'Body:', raw.slice(0, 500));
      throw new Error('Respuesta no es JSON (¿redirect a login, 419 CSRF, 500, rutas?)');
    }

    const data = JSON.parse(raw);
    console.log('Prox valoración data:', data);

    list.innerHTML = '';
    if (!Array.isArray(data) || data.length === 0) {
      list.innerHTML = '<li><strong>No hay clientes próximos a valoración.</strong></li>';
      return;
    }

    data.forEach(cli => {
      if (!cli.fecha_sig_valoracion) return;
      const fecha = new Date(cli.fecha_sig_valoracion);
      if (isNaN(fecha.getTime())) return;

      const dias = parseInt(cli.faltan_dias, 10);
      const fechaCol = fecha.toLocaleDateString('es-CO');

      let color = '';
      if (dias <= 2) color = 'red';
      else if (dias <= 5) color = 'orange';

      list.insertAdjacentHTML('beforeend', `
        <li style="color:${color}">
          <strong>${cli.nombre}</strong> – valoración en ${dias} día${dias>1?'s':''} (${fechaCol})
        </li>
      `);
    });
  } catch (e) {
    console.error('Fallo cargando prox valoración:', e);
    list.innerHTML = '<li><strong>Error al cargar datos (ver consola/Network).</strong></li>';
  }
});
</script>
        </div>


  <div class="row mb-4">
    <div class="col-md-6">
      <section class="module-section">
      <h3>📅 Clientes con menos de 3 clases disponibles</h3>
        <div class="info-box">
          <ul class="list-unstyled mb-0" id="clientesPorVencer">
            @if($clientesConPocasClases ->isEmpty())
              <li><strong>No hay clientes con menos de 3 clases disponibles</strong></li>
            @else
              @foreach($clientesConPocasClases as $pocasclases)
                <li>A <strong>{{ $pocasclases->nombre }}</strong> - le quedan <strong>{{ $pocasclases->clases }}</strong> clases</li>
              @endforeach
            @endif
          </ul>
        </div>
      </section>
  </div> 

  </div>

        
      </div>
    </div>
  @endif

</main>
@endsection
