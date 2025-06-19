@extends('layouts.app')
@section('title', 'Cliente')

@section('content')
  <!-- Carga CSS personalizado directamente -->
  <link rel="stylesheet" href="{{ asset('css/clients.css') }}">

  <div class="clients-container">
    <div class="clients-card">
      <!-- Encabezado centrado -->
      <header class="clients-header">
        <h1 class="clients-title">LISTA DE CLIENTES</h1>
      </header>

      <!-- Zona de acciones: Nuevo y filtros -->
      <div class="clients-actions">
        <button type="button" class="btn-new" data-toggle="modal" data-target="#create">
          + Nuevo Cliente
        </button>
        <div class="search-filter-group">
          <input type="text" id="inputBusqueda" class="clients-search" placeholder="Buscar clientes">
          <select id="selectColumna" class="clients-filter">
            <option value="0">ID</option>
            <option value="1">Nombre</option>
            <option value="2">Teléfono</option>
            <option value="3">Correo</option>
            <option value="4">Cédula</option>
          </select>
        </div>
      </div>

      <!-- Tabla de clientes con espacio y bordes modernos -->
      <div class="table-responsive">
        <table class="clients-table" id="tabla-clientes">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Cédula</th>
              <th>Clases</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $cliente)
              <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->clases }}</td>
                <td class="actions-cell">
                  <button type="button" class="btn-edit" data-toggle="modal" data-target="#edit{{ $cliente->id }}">
                    Editar
                  </button>
                  <button type="button" class="btn-delete" data-toggle="modal" data-target="#delete{{ $cliente->id }}">
                    Eliminar
                  </button>
                </td>
              </tr>
              @include('cliente.info')
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Modal de creación incluido -->
      @include('cliente.create')
    </div>
  </div>

  @include('cliente.accessnot')

  <script>
    document.getElementById('inputBusqueda').addEventListener('keyup', buscarEnTabla);

    function buscarEnTabla() {
      var textoBusqueda = document.getElementById('inputBusqueda').value.toLowerCase();
      var columnaSeleccionada = document.getElementById('selectColumna').value;
      var tabla = document.getElementById('tabla-clientes');
      var filas = tabla.getElementsByTagName('tr');
      for (var i = 1; i < filas.length; i++) {
        var celdas = filas[i].getElementsByTagName('td');
        var textoCelda = celdas[columnaSeleccionada].innerText.toLowerCase();
        filas[i].style.display = textoCelda.indexOf(textoBusqueda) > -1 ? '' : 'none';
      }
    }
  </script>
@endsection
