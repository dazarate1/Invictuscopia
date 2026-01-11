{{-- Modal Editar Métrica (un modal por registro, IDs únicos) --}}
<div class="modal fade" id="editmetrica{{ $metrica->id }}" tabindex="-1" aria-labelledby="editLabel{{ $metrica->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="editLabel{{ $metrica->id }}">Editar Valoración</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form action="{{ route('datos.update', ['id' => $metrica->id]) }}" method="POST" enctype="multipart/form-data" class="form-edit-metric">
        @csrf
        @method('PUT')

        <div class="modal-body">
          {{-- Mantén cliente_id pero como hidden --}}
          <input type="hidden" name="client_id" value="{{ $metrica->client_id }}"/>

          <div class="mb-2">
            <label for="fecha_valoracion_{{ $metrica->id }}" class="form-label">Fecha valoración</label>
            <input
              type="date"
              name="fecha_valoracion"
              id="fecha_valoracion_{{ $metrica->id }}"
              class="form-control"
              value="{{ \Carbon\Carbon::parse($metrica->fecha_valoracion)->format('Y-m-d') }}"
              required
            >
          </div>

          <div class="mb-2">
            <label for="peso_{{ $metrica->id }}" class="form-label">Peso (kg)</label>
            <input type="number" step="any" class="form-control" id="peso_{{ $metrica->id }}" name="peso" value="{{ $metrica->peso }}" required />
          </div>

          <div class="mb-2">
            <label for="imc_{{ $metrica->id }}" class="form-label">Índice Masa Corporal</label>
            <input type="number" step="any" class="form-control" id="imc_{{ $metrica->id }}" name="imc" value="{{ $metrica->imc }}" required />
          </div>

          <div class="mb-2">
            <label for="grasa_corporal_{{ $metrica->id }}" class="form-label">Grasa Corporal (%)</label>
            <input type="number" step="any" class="form-control" id="grasa_corporal_{{ $metrica->id }}" name="grasa_corporal" value="{{ $metrica->grasa_corporal }}" required />
          </div>

          <div class="mb-2">
            <label for="lvl_agua_{{ $metrica->id }}" class="form-label">Nivel de Agua (%)</label>
            <input type="number" step="any" class="form-control" id="lvl_agua_{{ $metrica->id }}" name="lvl_agua" value="{{ $metrica->lvl_agua }}" required />
          </div>

          <div class="mb-2">
            <label for="grasa_visc_{{ $metrica->id }}" class="form-label">Grasa Visceral</label>
            <input type="number" step="any" class="form-control" id="grasa_visc_{{ $metrica->id }}" name="grasa_visc" value="{{ $metrica->grasa_visc }}" required />
          </div>

          <div class="mb-2">
            <label for="musculo_{{ $metrica->id }}" class="form-label">Masa Muscular (Kg)</label>
            <input type="number" step="any" class="form-control" id="musculo_{{ $metrica->id }}" name="musculo" value="{{ $metrica->musculo }}" required />
          </div>

          <div class="mb-2">
            <label for="proteina_{{ $metrica->id }}" class="form-label">Proteínas (%)</label>
            <input type="number" step="any" class="form-control" id="proteina_{{ $metrica->id }}" name="proteina" value="{{ $metrica->proteina }}" required />
          </div>

          <div class="mb-2">
            <label for="metabolismo_{{ $metrica->id }}" class="form-label">Metabolismo Basal (kcal)</label>
            <input type="number" step="any" class="form-control" id="metabolismo_{{ $metrica->id }}" name="metabolismo" value="{{ $metrica->metabolismo }}" required />
          </div>

          <div class="mb-2">
            <label for="masa_osea_{{ $metrica->id }}" class="form-label">Masa ósea (kg)</label>
            <input type="number" step="any" class="form-control" id="masa_osea_{{ $metrica->id }}" name="masa_osea" value="{{ $metrica->masa_osea }}" required />
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn-new btn-save">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="delete{{ $metrica->id}}" tabindex="-1" aria-labelledby="deleteLabel{{ $metrica->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content clients-card">
      <div class="modal-header">
        <h5 class="modal-title clients-title" id="deleteLabel{{ $metrica->id}}">Eliminar Valoracion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <!--<form action="{{ route('cliente.destroy', $metrica->id) }}" method="POST">-->
      <form action="{{ route('metrics.destroy', $metrica->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <strong>¿Deseas eliminar esta valoracion?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn-delete">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>