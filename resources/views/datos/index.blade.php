@extends('home') {{-- Extiende la plantilla base --}}



@section('content')
<br><br>
<form id="clienteForm">
<div class="row">
    <div class="col-md-1">
        <select id="clienteSelect" class="form-control" onchange="cargarDatosCliente()">
            <option value="">Seleccione un cliente</option>
        </select>
    </div>
    <div class="col-md-5">
        <!-- Name input -->
        <div data-mdb-input-init class="form-outline">
        <input type="text" id="form8Example1" class="form-control" />
        <label class="form-label" for="form8Example1">Name</label>
        </div>
    </div>
    <div class="col-md-5">
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline">
        <input type="email" id="form8Example2" class="form-control" />
        <label class="form-label" for="form8Example2">Email address</label>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<hr />

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <!-- Name input -->
        <div data-mdb-input-init class="form-outline">
        <input type="text" id="form8Example3" class="form-control" />
        <label class="form-label" for="form8Example3">First name</label>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Name input -->
        <div data-mdb-input-init class="form-outline">
        <input type="text" id="form8Example4" class="form-control" />
        <label class="form-label" for="form8Example4">Last name</label>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline">
        <input type="email" id="form8Example5" class="form-control" />
        <label class="form-label" for="form8Example5">Email address</label>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        cargarClientes(); // Llama a la función cuando la página cargue
    });
    
    function cargarClientes() {
        fetch('/cliente') // Ruta en Laravel para obtener los clientes
            .then(response => response.json())
            .then(clientes => {
                console.log(clientes);
                let select = document.getElementById("clienteSelect");
                clientes.forEach(cliente => {
                    let option = document.createElement("option");
                    option.value = cliente.id;
                    option.textContent = cliente.nombre;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error cargando clientes:", error));
    }
    
    function cargarDatosCliente() {
        let id = document.getElementById("clienteSelect").value;
        if (!id) return;
    
        fetch(`/cliente/${id}`) // Ruta para obtener los datos del cliente
            .then(response => response.json())
            .then(cliente => {
                document.getElementById("form8Example1").value = cliente.nombre;
                document.getElementById("form8Example2").value = cliente.telefono;
                document.getElementById("form8Example3").value = cliente.correo;
            })
            .catch(error => console.error("Error cargando datos del cliente:", error));
    }
    </script>
@endsection
