<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Invictus') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/estilos.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">  
    @stack('styles')      
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
        </style>                                  
</head>
<body>
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
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
