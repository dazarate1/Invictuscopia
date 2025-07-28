<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invictus Gym</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/estilos.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">

    <!-- Scripts -->
   <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">  -->
    @stack('styles')  
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon"> 
    
    <style>
          html, body { height: 100%; margin: 0; font-family: 'Poppins', sans-serif; }
          .app-layout { display: flex; min-height: 100vh; }
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
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: background 0.2s, border-left-color 0.2s;
          }
          .sidebar a:hover {
            background-color: #495057;
            border-left-color: #f97316;
          }
          .sidebar a.active {
            background-color: #212529;
            border-left-color: #f97316;
          }
          .profile-section {
            margin-top: auto;
            border-top: 1px solid #495057;
          }
          .profile-section form button {
            display: block;
            padding: 0.75rem 1.25rem;
            color: #f8f9fa;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
            font-size: 0.95rem;
          }
          .profile-section form button:hover {
            background-color: #495057;
            text-decoration: none;
          }
          .main-content {
            flex: 1;
            background-color: #f8f9fa;
            padding: 2rem;
          }
          /* Dashboard styles */
          .dashboard-top {
            text-align: center;
            margin-bottom: 2rem;
          }
          .dashboard-top h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #1f2937;
          }
          .dashboard-top p {
            font-size: 1.1rem;
            color: #4b5563;
          }
          .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
          }
          .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
            max-width: 1200px;
            width: 100%;
          }
          .dashboard-card {
            flex: 1 1 280px;
            max-width: 350px;
          }
          .dashboard-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
          }
          .dashboard-card .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1f2937;
          }
          .dashboard-card ul li {
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 0.5rem;
          }

          .toast-success {
            background: #28a745; /* verde éxito */
            color: white;
            border-radius: 8px;
          }

          .toast-error {
            background: #dc3545 !important;
            color: white;
            border-radius: 8px;
          }
    </style>
  <!-- Toastify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                                
</head>

@if(Auth::check()) <!-- Solo para usuarios logueados -->
<script>
  // Variable global para capturar el código
  window.currentCode = "";

  // Función toast personalizada
  function mostrarToastSuccess(nombre, clasesRestantes) {
    const toastContent = document.createElement("div");
    toastContent.innerHTML = `
      <div style="font-family: 'Segoe UI', sans-serif;">
        <div style="color: black; font-weight: bold;">✅ Acceso permitido</div>
        <div style="color: black;">${nombre} clases restantes: ${clasesRestantes}</div>
      </div>
    `;
    Toastify({
      node: toastContent,
      duration: 5000,
      gravity: "top",
      position: "right",
      close: false,
      stopOnFocus: true,
      className: "toast-success"
    }).showToast();
  }

   function mostrarToastFail(nombre) {
    const toastContent = document.createElement("div");
    toastContent.innerHTML = `
      <div style="font-family: 'Segoe UI', sans-serif;">
        <div style="color: black; font-weight: bold;">❌ Acceso denegado</div>
        <div style="color: black;">${nombre} ya no tiene clases disponibles.</div>
      </div>
    `;
    Toastify({
      node: toastContent,
      duration: 5000,
      gravity: "top",
      position: "right",
      close: false,
      stopOnFocus: true,
      className: "toast-error"
    }).showToast();
  }

  // Escuchar teclas
  document.addEventListener("keydown", async function(e) {
    if (!isNaN(e.key)) {
      window.currentCode += e.key;
    }

    if (e.key === "Enter" && window.currentCode !== "") {
      const code = window.currentCode;
      window.currentCode = ""; // limpiar para la siguiente lectura

      try {
        const response = await axios.post("/api/validate-access", { code });

        if (response.data.access) {
          const client = await axios.get(`/api/client/${code}`);
          const clientData = client.data;

          if (clientData.clases > 0) {
            let newValue = clientData.clases - 1;
            await axios.put(`/api/client/${code}`, { value: newValue });

            // ✅ Toast de éxito
            mostrarToastSuccess(clientData.nombre, newValue);
          } else {
            // ⚠️ Sin clases
            mostrarToastFail(clientData.nombre);
          }
        } else {
          // ❌ Acceso denegado
          Toastify({
            text: "❌ Acceso denegado",
            duration: 5000,
            gravity: "top",
            position: "right",
            backgroundColor: "#dc3545",
            close: false
          }).showToast();
        }
      } catch (error) {
        // 🚫 Error en la petición
        Toastify({
          text: "🚫 Error al contactar con el servidor",
          duration: 5000,
          gravity: "top",
          position: "right",
          backgroundColor: "#6c757d",
          close: false
        }).showToast();
        console.error(error);
      }
    }
  });
</script>
@endif
<body>
      @auth
        <div class="app-layout">
          <nav class="sidebar">
            <a href="{{ url('/home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/cliente') }}" class="{{ request()->is('cliente') ? 'active' : '' }}">Lista de Clientes</a>
            <a href="{{ url('/datos') }}" class="{{ request()->is('datos') ? 'active' : '' }}">Datos</a>
            <div class="profile-section">
              <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit">Logout</button>
              </form>
            </div>
          </nav>
      @endauth 
            @yield('content')
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 
      <!-- Toastify JS -->
      <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>
</html>
