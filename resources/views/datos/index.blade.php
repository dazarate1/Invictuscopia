@extends('home')

<!-- Inyectar CSS personalizado directamente -->
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
<style>
  /* Estilos personalizados para la vista de Datos del Cliente */
  .clients-container {
    padding: 4rem 1rem;
    background: #fefaf6;
  }
  .clients-card {
    border: 2px solid #f97316;
    background: rgba(255, 255, 255, 0.95);
  }
  .clients-input,
  .clients-filter {
    background: #fff7f0;
    border-color: #f97316;
  }
  .clients-title {
    color: #f97316;
    margin-bottom: 1.5rem;
  }
</style>

@section('content')
  <div class="clients-container">
    <div class="clients-card">
      <h2 class="clients-title">Datos del Cliente</h2>
      <form id="clienteForm" class="space-y-6">
        <div class="form-group">
          <label for="clienteSelect" class="block font-medium text-gray-700">Seleccione Cliente</label>
          <select id="clienteSelect" class="clients-filter w-full" onchange="cargarDatosCliente()">
            <option value="">-- Seleccione un cliente --</option>
          </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="form-group">
            <label for="formNombre" class="block font-medium text-gray-700">Nombre</label>
            <input type="text" id="formNombre" class="clients-input" placeholder="Nombre" readonly />
          </div>
          <div class="form-group">
            <label for="formCorreo" class="block font-medium text-gray-700">Correo</label>
            <input type="email" id="formCorreo" class="clients-input" placeholder="Correo" readonly />
          </div>
          <div class="form-group">
            <label for="formTelefono" class="block font-medium text-gray-700">Teléfono</label>
            <input type="text" id="formTelefono" class="clients-input" placeholder="Teléfono" readonly />
          </div>
          <div class="form-group">
            <label for="formCedula" class="block font-medium text-gray-700">Cédula</label>
            <input type="text" id="formCedula" class="clients-input" placeholder="Cédula" readonly />
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
