@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
  <div class="login-container">
    {{-- IZQUIERDA: formulario + logo --}}
    <div class="login-left">
      <div class="login-card">
        <img src="{{ asset('img/logo-gym.png') }}" alt="Logo Gym" class="logo">
        <h2>Acceso a Miembros</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" required autofocus>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required>
          </div>
          <button type="submit">Entrar</button>
        </form>
        <div class="links">
          <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a><br>
          <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
        </div>
      </div>
    </div>

    {{-- DERECHA: imagen entrenador --}}
    <div class="login-right"></div>
  </div>
@endsection
