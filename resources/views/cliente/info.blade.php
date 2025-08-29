<!-- Modal Editar Cliente -->
<div class="modal fade" id="edit{{ $cliente->id }}" tabindex="-1" aria-labelledby="editLabel{{ $cliente->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="editLabel{{ $cliente->id }}">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('cliente.update', $cliente->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="clients-input" placeholder="Ingrese nombre" required value=" {{$cliente->nombre}}">
          </div>
          <div class="form-group">
            <label for="nacimiento">Fecha de nacimiento</label>
            <input type="date" name="nacimiento" id="nacimiento" class="clients-input" required value=" {{$cliente->fecha_nacimiento}}">
          </div>
          <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="clients-input" placeholder="Ingrese cédula" required value=" {{$cliente->cedula}}">
          </div>
          <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="clients-input" placeholder="Ingrese celular" required value=" {{$cliente->celular}}">
          </div>
          <div class="form-group">
            <label for="eps">Eps</label>
            <input type="text" name="eps" id="eps" class="clients-input" placeholder="Ingrese EPS" required value=" {{$cliente->eps}}">
          </div>
          <div class="form-group">
            <label for="ocupacion">Ocupacion</label>
            <input type="text" name="ocupacion" id="ocupacion" class="clients-input" placeholder="Ingrese ocupacion" required value=" {{$cliente->ocupacion}}">
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" class="clients-input" placeholder="correo@ejemplo.com" required value=" {{$cliente->correo}}">
          </div>
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" class="clients-input" required value=" {{$cliente->edad}}">
          </div>
          <div class="form-group">
            <label for="rh">R-H</label>
            <input type="text" name="rh" id="rh" class="clients-input" placeholder="Ingrese grupo sanguineo" required value=" {{$cliente->rh}}">
          </div>
          <div class="form-group">
            <label for="contact_emer">Nombre contacto de emergencia</label>
            <input type="text" name="contact_emer" id="contact_emer" class="clients-input" placeholder="Ingrese Contacto de emergencia" required value=" {{$cliente->contact_emer}}">
          </div>
          <div class="form-group">
            <label for="num_contact_emer">Numero contacto de emergencia</label>
            <input type="text" name="num_contact_emer" id="num_contact_emer" class="clients-input" placeholder="Ingrese numero del contacto" required value=" {{$cliente->num_contact_emer}}">
          </div>
          <div class="form-group">
            <label for="patologia">Patologia</label>
            <input type="text" name="patologia" id="patologia" class="clients-input" value=" {{$cliente->patologia}}">
          </div>
          <div class="form-group">
            <label for="genero">Genero</label>
            <select id="genero" name="genero" class="clients-filter">
              <option></option>
              <option>Femenino</option>
              <option>Masculino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="estatura">Estatura</label>
            <input type="text" name="estatura" id="estatura" class="clients-input" placeholder="Ingrese la estatura" required value=" {{$cliente->estatura}}">
          </div>
          <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" name="peso" id="peso" class="clients-input" placeholder="Ingrese el peso" required value=" {{$cliente->peso}}">
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
