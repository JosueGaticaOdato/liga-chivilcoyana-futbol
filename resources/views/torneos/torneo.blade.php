@extends('layouts.app')

@section('title', content: $torneo->nombre)

@push('styles')
    @vite('resources/css/torneos/torneo.css')
    @vite('resources/css/torneos/tabla.css')
    @vite('resources/css/partidos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>{{ $torneo->nombre }} {{ $torneo->temporada }}</h1>
    </header>

    <main class="torneo-main">
        <section class="informacion-torneo">
            <article>
                <h4>Estado</h4>
                <p>{{ $torneo->estado }}</p>
            </article>
            <article>
                <h4>Equipos</h4>
                <p>200 equipos</p>
            </article>
            <article>
                <h4>Inicio</h4>
                <p>{{ $torneo->fecha_inicio }}</p>
            </article>
        </section>

        <section class="tabla-posiciones-torneo">
            <div class="data">
                <h2> <ion-icon name="stats-chart-outline" class="icon"></ion-icon> Tabla de Posiciones</h2>
                <a href="#" class="tabla-completa">Ver tabla completa <ion-icon name="arrow-forward-outline"></ion-icon></a>
            </div>
            <table class="tabla-posiciones">
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Equipo</th>
                        <th>PJ</th>
                        <th>PG</th>
                        <th>PE</th>
                        <th>PP</th>
                        <th>DG</th>
                        <th>Pts</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tabla as $index => $equipo)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="equipo">
                                <img src="{{ asset('storage/' . $equipo->escudo) }}" alt="Escudo {{ $equipo->nombre_pila }}">
                                <span>{{ $equipo->nombre_pila }}</span>
                            </td>
                            <td>{{ $equipo->pivot->partidos_jugados }}</td>
                            <td>{{ $equipo->pivot->ganados }}</td>
                            <td>{{ $equipo->pivot->empatados }}</td>
                            <td>{{ $equipo->pivot->perdidos }}</td>
                            <td>{{ $equipo->pivot->diferencia_goles }}</td>
                            <td class="pts">{{ $equipo->pivot->puntos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="sobre-torneo">
            <h3>Sobre el torneo</h3>
            <p>{{ $torneo->descripcion }}</p>
        </section>

        <section class="partidos-torneo">
            <div class="data">
                <h2> <ion-icon name="football-outline" class="icon"></ion-icon> Partidos</h2>
                <a href="#" class="fixture-completo">Ver fixture completo <ion-icon name="arrow-forward-outline"></ion-icon></a>
            </div>

            <section class="lista-partidos-torneo">

                @forelse ($proximosPartidos as $partido)
                    <article class="partido-card">

                        <header class="partido-header">
                            <time datetime="{{ $partido->fecha_hora->format('Y-m-d H:i') }}">
                                {{ $partido->fecha_hora_formateada }}
                            </time>

                            <span class="barra-estado {{ $partido->estado }}">
                                {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}</span>
                        </header>

                        <main class="partido-main">
                            <article class="equipo local">
                                <figure class="logo-equipo">
                                    <img src="{{ asset('storage/' . $partido->local->escudo) }}"
                                        alt="Escudo {{ $partido->local->nombre }}">
                                </figure>
                                <h3 class="equipo-nombre">{{ $partido->local->nombre_pila }}</h3>
                            </article>

                            <span class="vs">
                                @if ($partido->estado === 'programado')
                                    <span class="vs-text">VS</span>
                                @else
                                    {{ $partido->goles_local ?? 0 }}
                                    -
                                    {{ $partido->goles_visitante ?? 0 }}
                                @endif
                            </span>

                            <article class="equipo visitante">
                                <figure class="logo-equipo">
                                    <img src="{{ asset('storage/' . $partido->visitante->escudo) }}"
                                        alt="Escudo {{ $partido->visitante->nombre }}">
                                </figure>
                                <h3 class="equipo-nombre">{{ $partido->visitante->nombre_pila }}</h3>
                            </article>
                        </main>

                        <footer class="partido-footer">
                            <p>{{ $partido->cancha ?? 'Estadio: A definir' }}</p>
                        </footer>

                    </article>

                @empty
                    <p>No hay partidos para este torneo.</p>
                @endforelse

            </section>


        </section>
    </main>

@endsection
