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
        @foreach ($equipos as $index => $equipo)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td class="equipo">
                    <img src="{{ asset('storage/' . $equipo->escudo) }}" alt="Escudo {{ $equipo->nombre_pila }}">
                    <span>{{ $equipo->nombre_pila }}</span>
                </td>

                @if ($variant === 'full')
                    <td class="pts">{{ $equipo->pivot->puntos }}</td>
                    <td>{{ $equipo->pivot->partidos_jugados }}</td>
                    <td>{{ $equipo->pivot->ganados }}</td>
                    <td>{{ $equipo->pivot->empatados }}</td>
                    <td>{{ $equipo->pivot->perdidos }}</td>
                    <td>{{ $equipo->pivot->goles_favor }}</td>
                    <td>{{ $equipo->pivot->goles_contra }}</td>
                    <td>{{ $equipo->pivot->diferencia_goles }}</td>
                @else
                    <td class="pts">{{ $equipo->pivot->puntos }}</td>
                    <td>{{ $equipo->pivot->partidos_jugados }}</td>
                    <td>{{ $equipo->pivot->diferencia_goles }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
