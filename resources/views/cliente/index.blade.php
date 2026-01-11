@extends('layouts.app')
@section('title', 'Cliente')

@section('content')
  <!-- Sombra naranja para el card -->
  <style>
    .clients-container {
    display: flex;
    width: -webkit-fill-available !important;
    justify-content: center;
    padding: 3rem 1rem;
    background: #f3f4f6;
    }
    .clients-card {
      box-shadow: 0 4px 15px rgba(249, 115, 22, 0.6);
    }

  </style>

  <div class="clients-container">
    <div class="clients-card">
      <!-- Encabezado centrado -->
      <header class="clients-header">
        <h1 class="clients-title">LISTA DE CLIENTES</h1>
      </header>

      <!-- Zona de acciones: Nuevo y filtros -->
      <div class="clients-actions">
        <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#create">
          + Nuevo Cliente
        </button>
        <!--<div class="search-filter-group">
          <input type="text" id="inputBusqueda" class="clients-search" placeholder="Buscar clientes">
          <select id="selectColumna" class="clients-filter">
            <option value="0">Nombre</option>
            <option value="1">Cedula</option>
            <option value="2">Plan</option>
            <option value="3">Clases</option>
          </select>
        </div>-->
        <form method="GET" action="{{ route('clientes.index') }}">
          <div>
            <select id="statusFilter" name="status" class="clients-filter" onchange="this.form.submit()">
              <option value="1" {{ ($status ?? 1) == 1 ? 'selected' : '' }}>Activos</option>
              <option value="0" {{ ($status ?? 1) == 0 ? 'selected' : '' }}>Inactivos</option>
            </select>

            
            <input type="text" name="search" class="clients-search" placeholder="Buscar..." value="{{ request('search') }}">
            
            <select name="column" class="clients-filter">
              <option value="nombre" {{ request('column') == 'nombre' ? 'selected' : '' }}>Nombre</option>
              <option value="cedula" {{ request('column') == 'cedula' ? 'selected' : '' }}>Cédula</option>
              <option value="plan" {{ request('column') == 'plan' ? 'selected' : '' }}>Plan</option>
              <option value="clases" {{ request('column') == 'clases' ? 'selected' : '' }}>Clases</option>
            </select>
            
            <button type="submit" class="btn-new" >Buscar</button>
          </div>
        </form>
      </div>

      <!-- Tabla de clientes con espacio y bordes modernos -->
      <div class="table-responsive">
        <table class="clients-table" id="tabla-clientes">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Cédula</th>
              <th>Plan</th>
              <th>Clases</th>
              <th>Vigencia</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $cliente)
            @php
              if (($cliente->clases < 5) && ($cliente->clases > 3) ) {
                # coloca color amarillo en la fila o como te parezca bonito mano
              }elseif($cliente->clases <= 3){
                # coloca color rojo en la fila o como te parezca bonito mano
              } 
            @endphp
              <tr>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->plan }}</td>
                <td>{{ $cliente->clases }}</td>
                @php
                $fecha = $cliente->vigencia_plan;
                $soloFecha = date('d-m-Y', strtotime($fecha));
                
                if ($cliente->estatus == '1') {
                  $estatus_cliente = "Activo";
                }else{
                  $estatus_cliente = "Inactivo";
                }
                @endphp
                <td>{{ $soloFecha }}</td>
                <td>{{$estatus_cliente}}</td>
                <td class="actions-cell">
                  <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit{{ $cliente->id }}">
                    Editar
                  </button>
                  <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#delete{{ $cliente->id }}">
                    Eliminar
                  </button>
                </td>
              </tr>
              @include('cliente.info')
            @endforeach
          </tbody>
        </table>
        

<!-- Links de paginación -->
<div class="mt-3">
  {{ $clientes->links() }}
</div>

      </div>

      <!-- Modal de creación incluido -->
      @include('cliente.create')
    </div>
  </div>

  @include('cliente.accessnot')

  <script>


    document.getElementById('statusFilter').addEventListener('change', function () {
      this.closest('form').submit();
    });

  </script>
@endsection
