@extends('layouts.app')

@section('title', 'Partido')

@push('styles')
    @vite('resources/css/partidos/show.css')
@endpush

@section('content')

    {{-- <header class="header-main">
        <h1>{{ $partido->local->nombre_pila }} vs {{ $partido->visitante->nombre_pila }}</h1>
    </header> --}}

    {{-- <section class="informacion-partido">
        <h2>Datos del partido</h2>
        <ul class="data-game">
            <li><ion-icon name="calendar-outline"></ion-icon>
                {{ $partido->fecha_partido?->translatedFormat('d \d\e F, Y') }}
                -
                {{ \Carbon\Carbon::parse($partido->hora_partido)->format('H:i') }} Hs.
            </li>
            <li><ion-icon name="football-outline"></ion-icon>
                {{ $partido->cancha }}</li>
            <li>{{ $partido->torneo->nombre }} - {{ $partido->fecha->nombre }}</li>
            <li>Clima API</li>
        </ul>
    </section> --}}

    <section class="informacion-partido">
        <h2>Datos del partido</h2>
        <ul class="datos-informacion-partido">
            <li>
                <span class="card-icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                </span>
                <div>
                    <h4>Fecha</h4>
                    <p>
                        {{ $partido->fecha_partido?->translatedFormat('d \d\e F, Y') }}
                        -
                        {{ \Carbon\Carbon::parse($partido->hora_partido)->format('H:i') }} Hs.
                    </p>
                </div>
            </li>
            <li>
                <span class="card-icon">
                    <ion-icon name="football-outline"></ion-icon>
                </span>
                <div>
                    <h4>Cancha</h4>
                    <p>{{ $partido->cancha }}</p>
                </div>
            </li>
            <li>
                <span class="card-icon">
                    <ion-icon name="football-outline"></ion-icon>
                </span>
                <div>
                    <h4>Torneo</h4>
                    <p>{{ $partido->torneo->nombre }} - {{ $partido->fecha->nombre }}</p>
                </div>
            </li>
        </ul>
    </section>

    <article class="partido">

        <!-- Equipo Local -->
        <section class="equipo equipo-local">
            <header class="equipo-header">
                <figure class="equipo-escudo">
                    <img src="{{ asset('storage/' . $partido->local->escudo) }}"
                        alt="Escudo {{ $partido->local->nombre_pila }}">
                </figure>
                <h2 class="equipo-nombre">{{ $partido->local->nombre_pila }}</h2>
                <p class="equipo-condicion">Local</p>
            </header>
        </section>

        <!-- Resultado y estado -->
        <section class="partido-info">
            @if ($partido->estado === 'programado')
                <span class="vs-text">VS</span>
            @else
                <p class="partido-resultado" aria-label="Resultado del partido">
                    <span class="goles-local">{{ $partido->goles_local ?? 0 }}</span>
                    <span class="separador">-</span>
                    <span class="goles-visitante">{{ $partido->goles_visitante ?? 0 }}</span>
                </p>
            @endif

            <span class="barra-estado {{ $partido->estado }}">
                {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
            </span>
        </section>

        <!-- Equipo Visitante -->
        <section class="equipo equipo-visitante">
            <header class="equipo-header">
                <figure class="equipo-escudo">
                    <img src="{{ asset('storage/' . $partido->visitante->escudo) }}"
                        alt="Escudo {{ $partido->visitante->nombre_pila }}">
                </figure>
                <h2 class="equipo-nombre">{{ $partido->visitante->nombre_pila }}</h2>
                <p class="equipo-condicion">Visitante</p>
            </header>
        </section>

    </article>


    <p>Estado: {{ $partido->estado }}</p>

    <h2>{{ $partido->goles_local }} - {{ $partido->goles_visitante }}</h2>

@endsection
