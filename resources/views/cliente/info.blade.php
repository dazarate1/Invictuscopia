<!-- Modal Editar Cliente -->
<div class="modal fade" id="edit{{ $cliente->id }}" tabindex="-1" aria-labelledby="editLabel{{ $cliente->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="editLabel{{ $cliente->id }}">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre{{ $cliente->id }}">Nombre</label>
            <input type="text" name="nombre" id="nombre{{ $cliente->id }}" class="clients-input" value="{{ $cliente->nombre }}" required>
          </div>
          <div class="form-group">
            <label for="telefono{{ $cliente->id }}">Teléfono</label>
            <input type="text" name="telefono" id="telefono{{ $cliente->id }}" class="clients-input" value="{{ $cliente->telefono }}" required>
          </div>
          <div class="form-group">
            <label for="correo{{ $cliente->id }}">Correo</label>
            <input type="email" name="correo" id="correo{{ $cliente->id }}" class="clients-input" value="{{ $cliente->correo }}" required>
          </div>
          <div class="form-group">
            <label for="cedula{{ $cliente->id }}">Cédula</label>
            <input type="text" name="cedula" id="cedula{{ $cliente->id }}" class="clients-input" value="{{ $cliente->cedula }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-new btn-save">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Eliminar Cliente -->
<div class="modal fade" id="delete{{ $cliente->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $cliente->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="deleteLabel{{ $cliente->id }}">Eliminar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Estás seguro de eliminar a <strong>{{ $cliente->nombre }}</strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-delete">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>
