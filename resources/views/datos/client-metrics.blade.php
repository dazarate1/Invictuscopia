<!-- Modal reutilizable -->
<div class="modal fade" id="metricsModal" tabindex="-1" aria-labelledby="metricsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="metricsForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="metricsLabel">Métricas del Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <!-- Campos de métricas -->
          <input type="hidden" id="clienteIdSeleccionado" name="cliente_id" />
          <div class="mb-2">
            <label for="score_corporal" class="form-label">Puntaje Corporal</label>
            <input type="number" class="form-control" id="score_corporal" name="score_corporal" required />
          </div>
          <div class="mb-2">
            <label for="peso" class="form-label">Peso (kg)</label>
            <input type="number" class="form-control" id="peso" name="peso" required />
          </div>
          <div class="mb-2">
            <label for="imc" class="form-label">Indice Masa Corporal</label>
            <input type="number" class="form-control" id="imc" name="imc" required />
          </div>
          <div class="mb-2">
            <label for="grasa_corporal" class="form-label">Grasa Corporal (%)</label>
            <input type="number" class="form-control" id="grasa_corporal" name="grasa_corporal" required />
          </div>
          <div class="mb-2">
            <label for="lvl_agua" class="form-label">Nivel de Agua (%)</label>
            <input type="number" class="form-control" id="lvl_agua" name="lvl_agua" required />
          </div>
          <div class="mb-2">
            <label for="grasa_visc" class="form-label">Grasa Visceral</label>
            <input type="number" class="form-control" id="grasa_visc" name="grasa_visc" required />
          </div>
          <div class="mb-2">
            <label for="musculo" class="form-label">Masa Muscular (Kg)</label>
            <input type="number" class="form-control" id="musculo" name="musculo" required />
          </div>
          <div class="mb-2">
            <label for="proteina" class="form-label">Proteínas (%)</label>
            <input type="number" class="form-control" id="proteina" name="proteina" required />
          </div>
          <div class="mb-2">
            <label for="metabolismo" class="form-label">Metabolismo Basal (kcal)</label>
            <input type="number" class="form-control" id="metabolismo" name="metabolismo" required />
          </div>
          <div class="mb-2">
            <label for="masa_osea" class="form-label">Masa ósea (kg)</label>
            <input type="number" class="form-control" id="masa_osea" name="masa_osea" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" style="background: #f97316; color: #fff; padding: .5rem 1rem; border: none; border-radius: .25rem;">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>
