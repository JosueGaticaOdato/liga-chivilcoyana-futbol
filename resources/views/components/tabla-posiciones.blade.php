<table class="tabla-posiciones">
    <thead>
        <tr>
            <th>Pos</th>
            <th>Equipo</th>

            @if ($variant === 'full')
                <th>PTS</th>
                <th>PJ</th>
                <th>PG</th>
                <th>PE</th>
                <th>PP</th>
                <th>GF</th>
                <th>GC</th>
                <th>DG</th>
            @else
                <th>PTS</th>
                <th>PJ</th>
                <th>DG</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach ($equipos as $index => $equipoFase)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td class="equipo">
                    <img src="{{ asset('storage/' . $equipoFase->equipo->escudo) }}" alt="Escudo {{ $equipoFase->equipo->nombre }}">
                    <span>{{ $equipoFase->equipo->nombre }}</span>
                </td>

                @if ($variant === 'full')
                    <td class="pts">{{ $equipoFase->puntos }}</td>
                    <td>{{ $equipoFase->partidos_jugados }}</td>
                    <td>{{ $equipoFase->ganados }}</td>
                    <td>{{ $equipoFase->empatados }}</td>
                    <td>{{ $equipoFase->perdidos }}</td>
                    <td>{{ $equipoFase->goles_favor }}</td>
                    <td>{{ $equipoFase->goles_contra }}</td>
                    <td>{{ $equipoFase->diferencia_goles }}</td>
                @else
                    <td class="pts">{{ $equipoFase->puntos }}</td>
                    <td>{{ $equipoFase->partidos_jugados }}</td>
                    <td>{{ $equipoFase->diferencia_goles }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
