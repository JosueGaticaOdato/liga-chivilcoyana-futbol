@extends('layouts.app2')

@section('title', 'Mi equipo')

@push('styles')
    @vite('resources/css-old/equipos/show.css')
@endpush

@section('content')

    <header class="header-main">
        <figure class="header-equipo-escudo">
            <img src="{{ asset('storage/' . $club->escudo) }}" alt="Escudo {{ $club->nombre }}">
        </figure>
        <h1>{{ $club->nombre_institucional }}</h1>
    </header>

    <section class="club-layout">

        <div>
            <section class="sobre-club">
                <header class="sobre-club-header">
                    <h2>
                        <ion-icon name="alert-circle-outline" class="icon"></ion-icon>
                        Sobre el Club
                    </h2>
                </header>

                <article class="sobre-club-article">
                    <p>
                        {{ $club->descripcion }}
                    </p>
                </article>

                <ul class="sobre-club-stats">
                    <li>
                        <span class="label">Fundación</span>
                        <strong>{{ $club->fecha_fundacion }}</strong>
                    </li>
                    @if ($club)
                    <li>
                        <span class="label">Estadio</span>
                        <strong>{{ $club->nombre }}</strong>
                    </li>
                    @endif
                </ul>
            </section>

            @if (isset($ultimosPartidos) && count($ultimosPartidos) > 0)
            <section class="resultados-club">
                <header class="resultados-club-header">
                    <h2> <ion-icon name="football-outline" class="icon"></ion-icon> Últimos Resultados</h2>
                </header>

                <ul class="resultados-club-list">
                    @foreach ($ultimosPartidos as $partido)
                        @php
                            $esLocal = $partido->equipo_local_id === $club->id;

                            $golesEquipo = $esLocal ? $partido->goles_local : $partido->goles_visitante;
                            $golesRival = $esLocal ? $partido->goles_visitante : $partido->goles_local;

                            if ($golesEquipo > $golesRival) {
                                $resultado = 'Victoria';
                                $clase = 'result--win';
                            } elseif ($golesEquipo < $golesRival) {
                                $resultado = 'Derrota';
                                $clase = 'result--loss';
                            } else {
                                $resultado = 'Empate';
                                $clase = 'result--draw';
                            }

                            $rival = $esLocal ? $partido->visitante : $partido->local;
                        @endphp

                        <li>
                            <a href="{{ route('partidos.show', $partido) }}" class="result {{ $clase }}">
                                <time datetime="{{ $partido->fecha_partido }}">
                                    {{ \Carbon\Carbon::parse($partido->fecha_partido)->format('d M') }}
                                </time>

                                <span class="team local">{{ $club->nombre }}</span>

                                <strong class="score">
                                    {{ $golesEquipo }} - {{ $golesRival }}
                                </strong>

                                <span class="team">{{ $rival->nombre }}</span>

                                <span class="badge">{{ $resultado }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
            @endif
        </div>

        @if (isset($torneo))
        <div>
            <section class="posicion-club">
                <h2>Posición Actual - {{ $torneo->nombre }}</h2>
                
                <p class="posicion-rank">
                    <strong>{{ $posicion }}°</strong> / {{ $totalEquipos }} Equipos
                </p>

                <ul class="posicion-stats">
                    <li>
                        <strong>{{ $equipoTabla->puntos }}</strong>
                        <span>Puntos</span>
                    </li>
                    <li>
                        <strong>{{ $equipoTabla->partidos_jugados }}</strong>
                        <span>Jugados</span>
                    </li>
                    <li>
                        <strong>
                            {{ $equipoTabla->diferencia_goles > 0 ? '+' : '' }}{{ $equipoTabla->diferencia_goles }}</strong>
                        <span>Diferencia</span>
                    </li>
                </ul>
            </section>

            <section class="proximo-partido-club">
                <h2>Próximo Partido</h2>

                @if ($proximoPartido)
                    <x-partido-card :partido="$proximoPartido" />
                @else
                    <p>No hay partidos programados.</p>
                @endif
            </section>
        </div>
        @endif

    </section>
@endsection
