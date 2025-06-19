@extends('home')

@section('content')
  <!-- Carga CSS personalizado directamente -->
  <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
  <style>
    /* Estilos generales para tarjetas de cliente */
    .clients-container {
      padding: 4rem 1rem;
      background: #f3f4f6;
    }
    .clients-card {
      max-width: 800px;
      margin: 0 auto;
      box-shadow: 0 4px 15px rgba(249, 115, 22, 0.6);
      background: #ffffff;
      padding: 2.5rem;
      border-radius: 1rem;
    }
    .clients-title {
      color: #1f2937;
      margin-bottom: 2rem;
      text-align: center;
      font-size: 1.75rem;
      font-weight: 700;
    }
    .form-label {
      font-weight: 500;
      color: #4b5563;
    }
    .clients-input,
    .clients-filter {
      background: #fff7f0;
      border: 1px solid #f97316;
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      width: 100%;
      transition: border-color 0.2s;
    }
    .clients-input:focus,
    .clients-filter:focus {
      outline: none;
      border-color: #ea580c;
      box-shadow: 0 0 0 3px rgba(249,115,22,0.25);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
  </style>

  <div class="clients-container">
    <div class="clients-card">
      <h2 class="clients-title">Datos del Cliente</h2>
      <form id="clienteForm">
        <div class="form-group">
          <label for="clienteSelect" class="form-label">Seleccione Cliente</label>
          <select id="clienteSelect" class="clients-filter" onchange="cargarDatosCliente()">
            <option value="">-- Seleccione un cliente --</option>
          </select>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="form-group">
              <label for="formNombre" class="form-label">Nombre</label>
              <input type="text" id="formNombre" class="clients-input" placeholder="Nombre" readonly />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="formCorreo" class="form-label">Correo</label>
              <input type="email" id="formCorreo" class="clients-input" placeholder="Correo" readonly />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="formTelefono" class="form-label">Teléfono</label>
              <input type="text" id="formTelefono" class="clients-input" placeholder="Teléfono" readonly />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="formCedula" class="form-label">Cédula</label>
              <input type="text" id="formCedula" class="clients-input" placeholder="Cédula" readonly />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", cargarClientes);
    function cargarClientes() {
      fetch('/cliente')
        .then(r => r.json())
        .then(clientes => {
          const select = document.getElementById('clienteSelect');
          clientes.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.id;
            opt.textContent = c.nombre;
            select.appendChild(opt);
          });
        });
    }
    function cargarDatosCliente() {
      const id = document.getElementById('clienteSelect').value;
      if (!id) return;
      fetch(`/cliente/${id}`)
        .then(r => r.json())
        .then(c => {
          document.getElementById('formNombre').value = c.nombre;
          document.getElementById('formCorreo').value = c.correo;
          document.getElementById('formTelefono').value = c.telefono;
          document.getElementById('formCedula').value = c.cedula;
        });
    }
  </script>
@endsection
