@if($metricas->isEmpty())
    <p>No hay métricas registradas para este cliente.</p>
@else
<div id="historialMetricas" class="mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha Valoracion</th>
                <th>Fecha proxima valoracion</th>
                <th>Puntaje Corporal</th>
                <th>Peso (kg)</th>
                <th>Indice Masa Corporal</th>
                <th>Grasa Corporal (%)</th>
                <th>Nivel de agua (%)</th>
                <th>Grasa Visceral</th>
                <th>Masa Muscular (Kg)</th>
                <th>Proteínas (%)</th>
                <th>Metabolismo Basal (kcal)</th>
                <th>Masa ósea (kg)</th>
                <!-- Agrega más columnas si lo necesitas -->
            </tr>
        </thead>
        <tbody>
            @php
    $anterior = null;
@endphp

@foreach($metricas as $metrica)
    <tr>
        <td>{{$metrica->fecha_valoracion}}</td>
        <td>{{$metrica->fecha_sig_valoracion}}</td>
        {{-- SCORE CORPORAL (flecha verde si sube, roja si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->score_corporal > $anterior->score_corporal) {
                        $color = 'green';
                        $flecha = asset('img/green_arrow_up.svg');
                    } elseif ($metrica->score_corporal < $anterior->score_corporal) {
                        $color = 'red';
                        $flecha = asset('img/red_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->score_corporal }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- PESO (flecha roja si sube, verde si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->peso > $anterior->peso) {
                        $color = 'red';
                        $flecha = asset('img\red_arrow_up.svg');
                    } elseif ($metrica->peso < $anterior->peso) {
                        $color = 'green';
                        $flecha = asset('img\green_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->peso }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- IMC (roja si sube, verde si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->imc > $anterior->imc) {
                        $color = 'red';
                        $flecha = asset('img\red_arrow_up.svg');
                    } elseif ($metrica->imc < $anterior->imc) {
                        $color = 'green';
                        $flecha = asset('img\green_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->imc}}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- GRASA CORPORAL (roja si sube, verde si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->grasa_corporal > $anterior->grasa_corporal) {
                        $color = 'red';
                        $flecha = asset('img\red_arrow_up.svg');
                    } elseif ($metrica->grasa_corporal < $anterior->grasa_corporal) {
                        $color = 'green';
                        $flecha = asset('img\green_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->grasa_corporal}}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- NIVEL DE AGUA (verde si sube, roja si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->lvl_agua > $anterior->lvl_agua) {
                        $color = 'green';
                        $flecha = asset('img/green_arrow_up.svg');
                    } elseif ($metrica->lvl_agua < $anterior->lvl_agua) {
                        $color = 'red';
                        $flecha = asset('img/red_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->lvl_agua }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- GRASA VISCERAL (roja si sube, verde si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->grasa_visc > $anterior->grasa_visc) {
                        $color = 'red';
                        $flecha = asset('img\red_arrow_up.svg');
                    } elseif ($metrica->grasa_visc < $anterior->grasa_visc) {
                        $color = 'green';
                        $flecha = asset('img\green_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->grasa_visc}}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- MASA MUSCULAR (verde si sube, roja si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->musculo > $anterior->musculo) {
                        $color = 'green';
                        $flecha = asset('img/green_arrow_up.svg');
                    } elseif ($metrica->musculo < $anterior->musculo) {
                        $color = 'red';
                        $flecha = asset('img/red_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->musculo }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- PROTEÍNA (verde si sube, roja si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->proteina > $anterior->proteina) {
                        $color = 'green';
                        $flecha = asset('img/green_arrow_up.svg');
                    } elseif ($metrica->proteina < $anterior->proteina) {
                        $color = 'red';
                        $flecha = asset('img/red_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->proteina }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- METABOLISMO (verde si sube, roja si baja) --}}
        <td>
            @php
                $color = ''; $flecha = '';
                if ($anterior) {
                    if ($metrica->metabolismo > $anterior->metabolismo) {
                        $color = 'green';
                        $flecha = asset('img/green_arrow_up.svg');
                    } elseif ($metrica->metabolismo < $anterior->metabolismo) {
                        $color = 'red';
                        $flecha = asset('img/red_arrow_down.svg');
                    }
                }
            @endphp
            <span style="color: {{ $color }}">
                {{ $metrica->metabolismo }}
                @if($flecha)
                    <img src="{{ $flecha }}" alt="Flecha" />
                @endif
            </span>
        </td>

        {{-- MASA ÓSEA (sin flechas por ahora) --}}
        <td>{{ $metrica->masa_osea }}</td>
        <td class="actions-cell">
            <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editmetrica{{ $metrica->id }}">
                Editar
            </button>
        </td>
    </tr>


    {{-- Actualiza el valor anterior --}}
    @php
        $anterior = $metrica;
    @endphp
@endforeach
        </tbody>
    </table>
</div>
@foreach($metricas as $metrica)
    @include('datos.edit')
@endforeach
@endif
