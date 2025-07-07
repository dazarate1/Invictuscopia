@if($metricas->isEmpty())
    <p>No hay métricas registradas para este cliente.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
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
        {{-- SCORE CORPORAL (flecha verde si sube) --}}
        <td>
            {{ $metrica->score_corporal }}
            @if($anterior && $metrica->score_corporal > $anterior->score_corporal)
                <span style="color:green;"><img src="{{ asset('img\green_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- PESO (flecha roja si sube) --}}
        <td>
            {{ $metrica->peso }}
            @if($anterior && $metrica->peso > $anterior->peso)
                <span style="color:red;"><img src="{{ asset('img\red_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- IMC (roja si sube) --}}
        <td>
            {{ $metrica->imc }}
            @if($anterior && $metrica->imc > $anterior->imc)
                <span style="color:red;"><img src="{{ asset('img\red_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- GRASA CORPORAL (roja si sube) --}}
        <td>
            {{ $metrica->grasa_corporal }}
            @if($anterior && $metrica->grasa_corporal > $anterior->grasa_corporal)
                <span style="color:red;"><img src="{{ asset('img\red_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- NIVEL DE AGUA (verde si sube) --}}
        <td>
            {{ $metrica->lvl_agua }}
            @if($anterior && $metrica->lvl_agua > $anterior->lvl_agua)
                <span style="color:green;"><img src="{{ asset('img\green_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- GRASA VISCERAL (roja si sube) --}}
        <td>
            {{ $metrica->grasa_visc }}
            @if($anterior && $metrica->grasa_visc > $anterior->grasa_visc)
                <span style="color:red;"><img src="{{ asset('img\red_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- MASA MUSCULAR (verde si sube) --}}
        <td>
            {{ $metrica->musculo }}
            @if($anterior && $metrica->musculo > $anterior->musculo)
                <span style="color:green;"><img src="{{ asset('img\green_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- PROTEÍNA (verde si sube) --}}
        <td>
            {{ $metrica->proteina }}
            @if($anterior && $metrica->proteina > $anterior->proteina)
                <span style="color:green;"><img src="{{ asset('img\green_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- METABOLISMO (verde si sube) --}}
        <td>
            {{ $metrica->metabolismo }}
            @if($anterior && $metrica->metabolismo > $anterior->metabolismo)
                <span style="color:green;"><img src="{{ asset('img\green_arrow_up.svg') }}"></span>
            @endif
        </td>

        {{-- MASA ÓSEA (sin flechas por ahora) --}}
        <td>{{ $metrica->masa_osea }}</td>
    </tr>

    {{-- Actualiza el valor anterior --}}
    @php
        $anterior = $metrica;
    @endphp
@endforeach
        </tbody>
    </table>
@endif
