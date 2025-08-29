@extends('layouts.app')

@section('content')  
  <style>
    /* Estilos generales para tarjetas de cliente */
    .clients-container {
      padding: 4rem 1rem;
      background: #f3f4f6;
      width: -webkit-fill-available;
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
    /* Botón primario con fondo naranja oscuro */
      .btn.btn-primary.mt-2 {
        background-color:#f97316;
        border-color: #f97316;
      }
      .btn.btn-primary.mt-2:hover {
        background-color: #f97316;
        border-color: #f97316;
      }
    /*Estilos del buscador de clientes*/
    .autocomplete-results {
    list-style: none;
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    padding: 0;
    margin: 0;
    background-color: white;
    position: absolute;
    z-index: 1000;
    width: 30%;
    }

    .autocomplete-results li {
      padding: 8px;
      cursor: pointer;
    }

    .autocomplete-results li:hover {
      background-color: #f0f0f0;
    }
  </style>

  <!-- Toast para notificaciones -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
  <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Métricas guardadas correctamente.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>


  <div class="clients-container">
    <div class="clients-card">
      <h2 class="clients-title">Datos del Cliente</h2>
      <form id="clienteForm">
        <!--<div class="form-group">
          <label for="clienteSelect" class="form-label">Seleccione Cliente</label>
          <select id="clienteSelect" class="clients-filter" onchange="cargarDatosCliente()">
            <option value="">-- Seleccione un cliente --</option>
          </select>
        </div>-->

        <div class="form-group">
          <label for="clienteSearch" class="form-label">Buscar Cliente</label>
          <input type="text" id="clienteSearch" class="clients-filter" placeholder="Escriba nombre del cliente..." oninput="filtrarClientes()" autocomplete="off" />
          <ul id="clienteResultados" class="autocomplete-results"></ul>
        </div>

        <div class="row g-4">
          <div class="col-md-5">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" class="clients-input" placeholder="Nombre" readonly />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="nacimiento">Fecha Nacimiento</label>
              <input type="text" id="nacimiento" class="clients-input" placeholder="Fecha nacimiento" readonly />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="genero">Genero</label>
              <input type="text" id="genero" class="clients-input" placeholder="Genero" readonly />
            </div>
          </div>
          <!-- Seccion 2-->
          <div class="col-sm-4">
            <div class="form-group">
              <label for="cedula">Cedula</label>
              <input type="text" id="cedula" class="clients-input" placeholder="Cedula" readonly />
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="celular">Celular</label>
              <input type="text" id="celular" class="clients-input" placeholder="Celular" readonly />
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="eps">EPS</label>
              <input type="text" id="eps" class="clients-input" placeholder="EPS" readonly />
            </div>
          </div>
          <!-- seccion 3 -->
          <div class="col-md-5">
            <div class="form-group">
              <label for="ocupacion">Ocupacion</label>
              <input type="text" id="ocupacion" class="clients-input" placeholder="Ocupacion" readonly />
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="correo">Correo</label>
              <input type="email" id="correo" class="clients-input" placeholder="Correo" readonly />
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="edad">Edad</label>
              <input type="text" id="edad" class="clients-input" placeholder="Edad" readonly />
            </div>
          </div>
          <!-- seccion 4-->
          <div class="col-md-6">
            <div class="form-group">
              <label for="contact_emer">Contacto de Emergencia</label>
              <input type="text" id="contact_emer" class="clients-input" placeholder="Contacto de emergencia" readonly />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="num_contact_emer">Numero</label>
              <input type="text" id="num_contact_emer" class="clients-input" placeholder="Numero de contacto" readonly />
            </div>
          </div>

          <!-- Seccion 5 -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="patologia">Patologia</label>
              <input type="text" id="patologia" class="clients-input" placeholder="Patologia" readonly />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="estatura">Estatura</label>
              <input type="text" id="estatura" class="clients-input" placeholder="Estatura" readonly />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="peso_inicial">Peso</label>
              <input type="text" id="peso_inicial" class="clients-input" placeholder="Peso" readonly />
            </div>
          </div>

        </div>
      </form>

      <button id="btnAbrirModal" type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#metricsModal" disabled>
        Agregar Métricas
      </button>
      <div id="historialMetricas" class="mt-4" style="display: none;"></div>

    </div>

    @include('datos.client-metrics')
  </div>

 <!-- <script>
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
  </script>-->

<!-- Script para busqueda de clientes por texto y sugerencias. Activacion de boton para apertura
de modal para datos de valoracion
-->
<script>
  let listaClientes = [];
  let clienteSeleccionado = null;

  document.addEventListener("DOMContentLoaded", () => {
    fetch('/api/cliente') // cambia si usas otra ruta
      .then(r => r.json())
      .then(clientes => {
        listaClientes = clientes;
      });

    // Manejo del formulario de métricas
    document.getElementById('metricsForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const data = {
        client_id: document.getElementById('clienteIdSeleccionado').value,
        fecha_valoracion: document.getElementById('fecha_valoracion').value,
        score_corporal: document.getElementById('score_corporal').value,
        peso: document.getElementById('peso').value,
        imc: document.getElementById('imc').value,
        grasa_corporal: document.getElementById('grasa_corporal').value,
        lvl_agua: document.getElementById('lvl_agua').value,
        grasa_visc: document.getElementById('grasa_visc').value,
        musculo: document.getElementById('musculo').value,
        proteina: document.getElementById('proteina').value,
        metabolismo: document.getElementById('metabolismo').value,
        masa_osea: document.getElementById('masa_osea').value,
      };

      fetch('/storemetrics', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(data)
      })
        .then(r => r.json())
        .then(respuesta => {
          document.getElementById('metricsForm').reset();
          bootstrap.Modal.getInstance(document.getElementById('metricsModal')).hide();

          metricsSuccess();

          if(clienteSeleccionado && clienteSeleccionado.id) {
            fetch(`/cliente/${clienteSeleccionado.id}/metrics`)
            .then(res => res.text())
            .then(html =>
              {
              document.getElementById('historialMetricas').innerHTML = html;
            })
          }
        });
    });
  });

  function filtrarClientes() {
    const entrada = document.getElementById('clienteSearch').value.toLowerCase();
    const resultados = document.getElementById('clienteResultados');
    resultados.innerHTML = '';

    if (entrada.length === 0) return;

    const filtrados = listaClientes.filter(c =>
      c.nombre.toLowerCase().includes(entrada)
    );

    filtrados.forEach(c => {
      const li = document.createElement('li');
      li.textContent = c.nombre;
      li.classList.add('list-group-item');
      li.onclick = () => seleccionarCliente(c);
      resultados.appendChild(li);
    });
  }

  function seleccionarCliente(cliente) {
    clienteSeleccionado = cliente;
    document.getElementById('clienteSearch').value = cliente.nombre;
    document.getElementById('clienteResultados').innerHTML = '';

    document.getElementById('nombre').value = cliente.nombre;

    const fechaStr = cliente.fecha_nacimiento; 
    const fecha = new Date(fechaStr);
    const opciones = { day: "2-digit", month: "2-digit", year: "numeric" };
    const formato = fecha.toLocaleDateString("es-ES", opciones);
    document.getElementById('nacimiento').value = formato;

    document.getElementById('genero').value = cliente.genero;
    document.getElementById('cedula').value = cliente.cedula;
    document.getElementById('celular').value = cliente.celular;
    document.getElementById('eps').value = cliente.eps;
    document.getElementById('ocupacion').value = cliente.ocupacion;
    document.getElementById('correo').value = cliente.correo;
    document.getElementById('edad').value = cliente.edad;
    document.getElementById('contact_emer').value = cliente.contact_emer;
    document.getElementById('num_contact_emer').value = cliente.num_contact_emer;
    document.getElementById('patologia').value = cliente.patologia;
    document.getElementById('estatura').value = cliente.estatura;
    document.getElementById('peso_inicial').value = cliente.peso;

    document.getElementById('btnAbrirModal').disabled = false;

    // Pasamos el ID al modal
    document.getElementById('clienteIdSeleccionado').value = cliente.id;
    fetch(`/cliente/${cliente.id}/metrics`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('historialMetricas').style.display = 'block';
            document.getElementById('historialMetricas').innerHTML = html;
        });
  }

  function metricsSuccess() {
    const toastElement = document.getElementById('toastSuccess');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
  }
  
</script>

@endsection
