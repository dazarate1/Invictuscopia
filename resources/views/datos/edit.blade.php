<!-- Modal reutilizable -->
<div class="modal fade" id="editmetrica{{ $metrica->id }}" tabindex="-1" aria-labelledby="editLabel{{ $metrica->id }}" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel{{ $metrica->id }}">Editar Valoracion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('metrics.update', $metrica->id) }}" method="POST" enctype="multipart/form-data" class="form-edit-metric">
                @csrf
                @method('PUT')
                <div class="modal-body">
                <!-- Campos de métricas -->
                <input type="text" id="clienteIdSeleccionado" name="cliente_id" value="{{$metrica->client_id}}"/>
                <div class="mb-2">
                    <label for= "fecha_valoracion" class="form-label">Fecha</label>
                    <input type="date" name="fecha_valoracion" id="fecha_valoracion" class="form-control" value="{{ \Carbon\Carbon::parse($metrica->fecha_valoracion)->format('Y-m-d') }}">
                </div>
                <!--<div class="mb-2">
                    <label for="score_corporal" class="form-label">Puntaje Corporal</label>
                    <input type="number" step="any" class="form-control" id="score_corporal" name="score_corporal" required />
                </div>-->
                <div class="mb-2">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="number" step="any" class="form-control" id="peso" name="peso" value="{{ $metrica->peso }}" required />
                </div>
                <div class="mb-2">
                    <label for="imc" class="form-label">Indice Masa Corporal</label>
                    <input type="number" step="any" class="form-control" id="imc" name="imc" value="{{ $metrica->imc }}" required />
                </div>
                <div class="mb-2">
                    <label for="grasa_corporal" class="form-label">Grasa Corporal (%)</label>
                    <input type="number" step="any" class="form-control" id="grasa_corporal" name="grasa_corporal" value="{{ $metrica->grasa_corporal }}" required />
                </div>
                <div class="mb-2">
                    <label for="lvl_agua" class="form-label">Nivel de Agua (%)</label>
                    <input type="number" step="any" class="form-control" id="lvl_agua" name="lvl_agua" value="{{ $metrica->lvl_agua }}" required />
                </div>
                <div class="mb-2">
                    <label for="grasa_visc" class="form-label">Grasa Visceral</label>
                    <input type="number" step="any" class="form-control" id="grasa_visc" name="grasa_visc" value="{{ $metrica->grasa_visc }}" required />
                </div>
                <div class="mb-2">
                    <label for="musculo" class="form-label">Masa Muscular (Kg)</label>
                    <input type="number" step="any" class="form-control" id="musculo" name="musculo" value="{{ $metrica->musculo }}" required />
                </div>
                <div class="mb-2">
                    <label for="proteina" class="form-label">Proteínas (%)</label>
                    <input type="number" step="any" class="form-control" id="proteina" name="proteina" value="{{ $metrica->proteina }}" required />
                </div>
                <div class="mb-2">
                    <label for="metabolismo" class="form-label">Metabolismo Basal (kcal)</label>
                    <input type="number" step="any" class="form-control" id="metabolismo" name="metabolismo" value="{{ $metrica->metabolismo }}" required />
                </div>
                <div class="mb-2">
                    <label for="masa_osea" class="form-label">Masa ósea (kg)</label>
                    <input type="number" step="any" class="form-control" id="masa_osea" name="masa_osea" value="{{ $metrica->masa_osea }}" required />
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn-new btn-save">Guardar</button>
                </div>
            </form>
    </div>
  </div>
</div>
