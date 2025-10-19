<!-- Modal: Agregar Cliente -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="createLabel">Agregar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="clients-input" placeholder="Ingrese nombre" required>
          </div>
          <div class="form-group">
            <label for="nacimiento">Fecha de nacimiento</label>
            <input type="date" name="nacimiento" id="nacimiento" class="clients-input" required>
          </div>
          <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="clients-input" placeholder="Ingrese cédula" required>
          </div>
          <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="clients-input" placeholder="Ingrese celular" required>
          </div>
          <div class="form-group">
            <label for="eps">Eps</label>
            <input type="text" name="eps" id="eps" class="clients-input" placeholder="Ingrese EPS" required>
          </div>
          <div class="form-group">
            <label for="ocupacion">Ocupacion</label>
            <input type="text" name="ocupacion" id="ocupacion" class="clients-input" placeholder="Ingrese ocupacion" required>
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" class="clients-input" placeholder="correo@ejemplo.com" required>
          </div>
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" class="clients-input" required>
          </div>
          <div class="form-group">
            <label for="rh">R-H</label>
            <input type="text" name="rh" id="rh" class="clients-input" placeholder="Ingrese grupo sanguineo" required>
          </div>
          <div class="form-group">
            <label for="contact_emer">Nombre contacto de emergencia</label>
            <input type="text" name="contact_emer" id="contact_emer" class="clients-input" placeholder="Ingrese Contacto de emergencia" required>
          </div>
          <div class="form-group">
            <label for="num_contact_emer">Numero contacto de emergencia</label>
            <input type="text" name="num_contact_emer" id="num_contact_emer" class="clients-input" placeholder="Ingrese numero del contacto" required>
          </div>
          <div class="form-group">
            <label for="patologia">Patologia</label>
            <input type="text" name="patologia" id="patologia" class="clients-input">
          </div>
          <div class="form-group">
            <label for="genero">Genero</label>
            <select id="genero" name="genero" class="clients-filter">
              <option value="Femenino">Femenino</option>
              <option value="Masculino">Masculino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="estatura">Estatura</label>
            <input type="text" name="estatura" id="estatura" class="clients-input" placeholder="Ingrese la estatura" required>
          </div>
          <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" name="peso" id="peso" class="clients-input" placeholder="Ingrese el peso" required>
          </div>
          <div class="form-group">
            <label for="ingreso">Fecha de ingreso</label>
            <input type="date" name="ingreso" id="ingreso" class="clients-input" required>
          </div>
          <div class="form-group">
            <label for= "plan" class="form-label">Plan</label>
            <select id="plan" name="plan" class="clients-filter">
              <option></option>
              <option>Mensual</option>
              <option>Pareja</option>
              <option>Semi 12</option>
              <option>Semi 16</option>
              <option>Pro 12</option>
              <option>Pro 16</option>
            </select>
          </div>
          <div class="form-group">
            <label for="clases">Cantidad de clases</label>
            <input type="text" name="clases" id="clases" class="clients-input" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-new">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
