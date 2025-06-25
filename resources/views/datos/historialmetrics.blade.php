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
            @foreach($metricas as $metrica)
                <tr>
                    <td>{{ $metrica->score_corporal}}</td>
                    <td>{{$metrica->peso}}</td>
                    <td>{{$metrica->imc}}</td>
                    <td>{{$metrica->grasa_corporal}}</td>
                    <td>{{$metrica->lvl_agua}}</td>
                    <td>{{$metrica->grasa_visc}}</td>
                    <td>{{$metrica->musculo}}</td>
                    <td>{{$metrica->proteina}}</td>
                    <td>{{$metrica->metabolismo}}</td>
                    <td>{{$metrica->masa_osea}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
