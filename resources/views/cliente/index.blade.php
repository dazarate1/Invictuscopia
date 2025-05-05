@extends('home')

@section('content')

<!--<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>-->

<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br><br>
        <h3>LISTA DE CLIENTES</h3>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
            Nuevo
          </button>

          <input type="text" id="inputBusqueda" placeholder="Buscar">
            <select id="selectColumna">
            <option value="0">ID</option>
            <option value="1">Nombre</option>
            <option value="2">Telefono</option>
            <option value="3">Correo</option>
            </select> 
        <div
            class="table-responsive"
        >
            <table
                class="table"
                id="tabla-clientes"
            >
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Clases</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr class="">
                        <td scope="row">{{$cliente->id}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->correo}}</td>
                        <td>{{$cliente->cedula}}</td>
                        <td>{{$cliente->clases}}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$cliente->id}}">
                                Editar
                              </button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$cliente->id}}">
                                Eliminar
                              </button>
                        </td>
                    </tr>
                    @include('cliente.info')    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        @include('cliente.create')
        
    </div>
    <div class="col-md-2">
    </div>
</div>

@include('cliente.accessnot')

<script>
    document.getElementById('inputBusqueda').addEventListener('keyup', function() {
        buscarEnTabla();
    });

    /*document.getElementById('selectColumna').addEventListener('change', function() {
        buscarEnTabla();
    });*/

    function buscarEnTabla() {
        var textoBusqueda = document.getElementById('inputBusqueda').value.toLowerCase();
        var columnaSeleccionada = document.getElementById('selectColumna').value;
        var tabla = document.getElementById('tabla-clientes');
        var filas = tabla.getElementsByTagName('tr');
        for (var i = 1; i < filas.length; i++) {
            var celdas = filas[i].getElementsByTagName('td');
            var textoCelda = celdas[columnaSeleccionada].innerText.toLowerCase();

            if (textoCelda.indexOf(textoBusqueda) > -1) {
                filas[i].style.display = '';
            } else {
                filas[i].style.display = 'none';
            }
        }
    }
</script>

@endsection