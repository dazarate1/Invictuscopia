<!-- Modal Editar Pago -->
<div class="modal fade" id="editpago{{ $pago->id }}" tabindex="-1" aria-labelledby="editLabel{{ $pago->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title" id="editLabel{{ $pago->id }}">Editar Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form action="{{ route('pago.update', $pago->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <!-- Fecha -->
          <div class="form-group mb-3">
            <label for="paydate" class="form-label">Fecha</label>
            <input 
              type="date" 
              name="paydate" 
              id="paydate" 
              class="clients-input" 
              value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
          </div>

          <!-- Nombre / Descripción -->
          <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre / Descripción</label>
            <input 
              type="text" 
              name="nombre" 
              id="nombre" 
              class="clients-input" 
              placeholder="Ej. Pago Cliente X" 
              value="{{ $pago->nombre }}">
          </div>

          <!-- Categoría -->
          <div class="form-group mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select name="category" class="clients-filter">
              <option value="Cliente" {{ $pago->category === 'Cliente' ? 'selected' : '' }}>Cliente</option>
              <option value="Proteínas" {{ $pago->category === 'Proteínas' ? 'selected' : '' }}>Proteínas</option>
              <option value="Gastos" {{ $pago->category === 'Gastos' ? 'selected' : '' }}>Gastos</option>
              <option value="Servicios" {{ $pago->category === 'Servicios' ? 'selected' : '' }}>Servicios</option>
            </select>
          </div>

          <!-- Bloque de cliente solo si la categoría es Cliente -->
          @if($pago->category === 'Cliente')
            <div class="form-group" style="display: block">
              <label for="clienteSelect" class="form-label">Buscar Cliente</label>
              <input 
                type="text" 
                class="clients-filter" 
                value="{{ optional($pago->cliente)->nombre }}" 
                placeholder="Nombre del cliente" />
              <input 
                type="hidden" 
                name="cliente_id" 
                value="{{ optional($pago->cliente)->id }}">
            </div>

            <div class="form-group mb-3" style="display: block">
              <label for="plan" class="form-label">Plan</label>
              <select name="plan" class="clients-filter">
                <option value="Mensual" {{ $pago->plan === 'Mensual' ? 'selected' : '' }}>Mensual</option>
                <option value="Pareja" {{ $pago->plan === 'Pareja' ? 'selected' : '' }}>Pareja</option>
                <option value="Semi 12" {{ $pago->plan === 'Semi 12' ? 'selected' : '' }}>Semi 12</option>
                <option value="Semi 16" {{ $pago->plan === 'Semi 16' ? 'selected' : '' }}>Semi 16</option>
                <option value="Pro 12" {{ $pago->plan === 'pro 12' ? 'selected' : '' }}>12</option>
                <option value="Pro 16" {{ $pago->plan === 'pro 16' ? 'selected' : '' }}>16</option>
              </select>
            </div>
          @endif

          <!-- Monto -->
          <div class="form-group mb-3">
            <label for="monto" class="form-label">Monto</label>
            @php
              $format_monto = number_format($pago->monto ?? 0, 0, ',', '.');
            @endphp
            <input 
              type="number" 
              name="monto" 
              id="monto" 
              class="clients-input" 
              value="{{ str_replace('.', '', $format_monto) }}" 
              placeholder="0">
          </div>

          <!-- Método de pago -->
          <div class="form-group mb-3">
            <label for="paymethod" class="form-label">Método</label>
            <select id="paymethod" name="paymethod" class="clients-filter">
              <option value="Efectivo" {{ $pago->paymethod === 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
              <option value="Tarjeta" {{ $pago->paymethod === 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
              <option value="Transferencia" {{ $pago->paymethod === 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
              <option value="Nequi" {{ $pago->paymethod === 'Nequi' ? 'selected' : '' }}>Nequi</option>
              <option value="Daviplata" {{ $pago->paymethod === 'Daviplata' ? 'selected' : '' }}>Daviplata</option>
              <option value="Banco de Bogota" {{ $pago->paymethod === 'Banco de Bogota' ? 'selected' : '' }}>Banco de Bogotá</option>
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

<!-- Modal Eliminar Pago -->
<div class="modal fade" id="deletepago{{ $pago->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $pago->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="deleteLabel{{ $pago->id }}">Eliminar Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('pago.destroy', $pago->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Estás seguro de eliminar este pago?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-delete">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>
