<div class="modal fade" id="createPagoModal" tabindex="-1" aria-labelledby="createPagoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title" id="createPagoLabel">Nuevo Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{route('pago.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for= "paydate" class="form-label">Fecha</label>
          <input type="date" name="paydate" id="paydate" class="clients-input" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
        </div>
        <div class="form-group mb-3">
          <label for= "nombre" class="form-label">Nombre / Descripción</label>
          <input type="text" name="nombre" id="nombre" class="clients-input" placeholder="Ej. Pago Cliente X">
        </div>
        <div class="form-group mb-3">
          <label for= "category" class="form-label">Categoría</label>
          <select id="category" name="category" class="clients-filter">
            <option></option>
            <option>Cliente</option>
            <option>Proteínas</option>
            <option>Gastos</option>
            <option>Servicios</option>
          </select>
        </div>

        <div class="form-group" id="buscarCliente" style="display: none">
          <label for="clienteSearch" class="form-label">Buscar Cliente</label>
          <input type="text" id="clienteSearch" class="clients-filter" placeholder="Escriba nombre del cliente..." oninput="filtrarClientes()" autocomplete="off" />
          <ul id="clienteResultados" class="autocomplete-results"></ul>
          <input type="hidden" name="cliente_id" id="clienteIdSeleccionado">
        </div>

        <div class="form-group mb-3" id="clientplan" style="display: none">
          <label for= "plan" class="form-label">Plan</label>
          <select id="plan" name="plan" class="clients-filter">
            <option></option>
            <option>Mensual</option>
            <option>Pareja</option>
            <option>Semi 12</option>
            <option>Semi 16</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for= "monto" class="form-label">Monto</label>
          <input type="number" name="monto" id="monto" class="clients-input" placeholder="0">
        </div>
        <div class="form-group mb-3">
          <label for= "paymethod" class="form-label">Método</label>
          <select id="paymethod" name="paymethod" class="clients-filter">
            <option>Efectivo</option>
            <option>Tarjeta</option>
            <option>Transferencia</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn-new-payment" data-bs-dismiss="modal">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script>

  let listaClientes = [];
  let clienteSeleccionado = null;

  document.addEventListener('DOMContentLoaded', function () {
    
    //Hide-show campo de planes para clientes
    const categoriaSelect = document.getElementById('category');
    const clienteField = document.getElementById('clientplan');
    const buscarCliente = document.getElementById('buscarCliente');

    categoriaSelect.addEventListener('change', function () {
      if (this.value === 'Cliente') {
        clienteField.style.display = 'block';
        buscarCliente.style.display = 'block';
      } else {
        clienteField.style.display = 'none';
        buscarCliente.style.display = 'block';
      }
    });

    fetch('/api/cliente') // cambia si usas otra ruta
      .then(r => r.json())
      .then(clientes => {
        listaClientes = clientes;
      });

  }
  


  /*const payDateInput = document.getElementById('paydate');  
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, '0'); // Meses van de 0 a 11
  const dd = String(today.getDate()).padStart(2, '0');  
  const currentDate = `${yyyy}-${mm}-${dd}`;
  payDateInput.value = currentDate;*/

  );

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

    // Pasamos el ID al modal
    document.getElementById('clienteIdSeleccionado').value = cliente.id;
  }


</script>
