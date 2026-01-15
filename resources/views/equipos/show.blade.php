@extends('layouts.app')

@section('title', 'Mi equipo')

@push('styles')
    @vite('resources/css/equipos/show.css')
@endpush

@section('content')

    <header class="header-main">
        <figure class="header-equipo-escudo">
            <img src="{{ asset('storage/' . $equipo->escudo) }}" alt="Escudo {{ $equipo->nombre }}">
        </figure>
        <h1>{{ $equipo->nombre }}</h1>
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
                        {{ $equipo->descripcion }}
                    </p>
                </article>

                <ul class="sobre-club-stats">
                    <li>
                        <span class="label">Fundación</span>
                        <strong>{{ $equipo->fecha_creacion->translatedFormat('d \\d\\e F \\d\\e Y') }}</strong>
                    </li>
                    <li>
                        <span class="label">Estadio</span>
                        <strong>{{ $equipo->estadio }}</strong>
                    </li>
                </ul>
            </section>

            <section class="resultados-club">
                <header class="resultados-club-header">
                    <h2> <ion-icon name="football-outline" class="icon"></ion-icon> Últimos Resultados</h2>
                </header>

                <ul class="resultados-club-list">
                    @foreach ($ultimosPartidos as $partido)
                        @php
                            $esLocal = $partido->equipo_local_id === $equipo->id;

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

                        <li class="result {{ $clase }}">
                            <time datetime="{{ $partido->fecha }}">
                                {{ \Carbon\Carbon::parse($partido->fecha)->format('d M') }}
                            </time>

                            <span class="team local">{{ $equipo->nombre_pila }}</span>

                            <strong class="score">
                                {{ $golesEquipo }} - {{ $golesRival }}
                            </strong>

                            <span class="team">{{ $rival->nombre_pila }}</span>

                            <span class="badge">{{ $resultado }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>

        <div>
            <section class="posicion-club">
                <h2>Posición Actual</h2>

                <p class="posicion-rank">
                    <strong>{{ $posicion }}°</strong> / {{ $totalEquipos }} Equipos
                </p>

                <ul class="posicion-stats">
                    <li>
                        <strong>{{ $equipoTabla->pivot->puntos }}</strong>
                        <span>Puntos</span>
                    </li>
                    <li>
                        <strong>{{ $equipoTabla->pivot->partidos_jugados }}</strong>
                        <span>Jugados</span>
                    </li>
                    <li>
                        <strong>
                            {{ $equipoTabla->pivot->diferencia_goles > 0 ? '+' : '' }}{{ $equipoTabla->pivot->diferencia_goles }}</strong>
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

    </section>
@endsection
