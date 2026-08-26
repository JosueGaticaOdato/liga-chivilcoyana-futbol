<table class="bg-[var(--color-bg-body)] border-collapse min-w-[80%] whitespace-nowrap mx-auto font-[var(--fuente-primaria)] table-fixed">
    <thead>
        <tr class="bg-[var(--color-primario)] text-[var(--color-letras-secundario)] text-[0.9rem] md:text-base lg:text-[1.1rem] font-bold">
            <th class="w-32 border-l-4 border-[var(--color-primario)] py-3 px-2 text-center">Pos</th>
            <th class="w-72 lg:w-auto py-3 px-2 pl-4 text-left sticky left-0 z-[3] bg-[var(--color-primario)] lg:static">Equipo</th>

            @if ($variant === 'full')
                <th class="w-[6.9rem] py-3 px-2 text-center">PTS</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">PJ</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">PG</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">PE</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">PP</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">GF</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">GC</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">DG</th>
            @else
                <th class="w-[6.9rem] py-3 px-2 text-center">PTS</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">PJ</th>
                <th class="w-[6.9rem] py-3 px-2 text-center">DG</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach ($equipos as $index => $equipoFase)
            <tr class="border-b border-[var(--color-body)] even:bg-[var(--color-impares)]">
                <td class="py-3 px-4 text-center align-middle font-bold">{{ $index + 1 }}</td>

                <td class="equipo flex flex-row items-center gap-3 text-left pl-4 py-3 px-4 text-[0.9rem] md:text-base lg:text-[1.1rem] sticky left-0 z-[2] odd:bg-[var(--color-blanco)] even:bg-[var(--color-impares)] lg:static">
                    <img class="w-6 h-6 lg:w-7 lg:h-7 object-contain" src="{{ asset('storage/' . $equipoFase->equipo->club->escudo) }}" alt="Escudo {{ $equipoFase->equipo->club->nombre }}">
                    <span>{{ $equipoFase->equipo->club->nombre }}</span>
                </td>

                @if ($variant === 'full')
                    <td class="py-3 px-4 text-center align-middle font-black">{{ $equipoFase->puntos }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->partidos_jugados }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->ganados }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->empatados }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->perdidos }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->goles_favor }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->goles_contra }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->diferencia_goles > 0 ? '+' : '' }}{{ $equipoFase->diferencia_goles }}</td>
                @else
                    <td class="py-3 px-4 text-center align-middle font-black">{{ $equipoFase->puntos }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->partidos_jugados }}</td>
                    <td class="py-3 px-4 text-center align-middle">{{ $equipoFase->diferencia_goles > 0 ? '+' : '' }}{{ $equipoFase->diferencia_goles }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>