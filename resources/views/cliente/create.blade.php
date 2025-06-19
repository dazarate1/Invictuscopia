<!-- Modal: Agregar Cliente -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="createLabel">Agregar Cliente</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="clients-input" placeholder="Ingrese nombre" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="clients-input" placeholder="Ingrese teléfono" required>
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" class="clients-input" placeholder="correo@ejemplo.com" required>
          </div>
          <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="clients-input" placeholder="Ingrese cédula" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-new">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
