@extends('layouts.app')

@section('title', 'Partido')

@push('styles')
    @vite('resources/css/partidos/show.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>{{ $fecha->nombre }}</h1>
        <p>{{ $torneo->nombre }}</p>
    </header>

    <section class="informacion-partido">
        <h2>Datos del partido</h2>
        <ul class="datos-informacion-partido">
            <li>
                <span class="card-icon">
                    <ion-icon name="calendar-outline" class="material-icons"></ion-icon>
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
                    <ion-icon name="location-outline" class="material-icons"></ion-icon>
                </span>
                <div>
                    <h4>Estadio</h4>
                    <p>{{ $partido->cancha ?? 'A definir' }}</p>
                </div>
            </li>
            <li>
                <span class="card-icon">
                    <ion-icon name="football-outline" class="material-icons"></ion-icon>
                </span>
                <div>
                    <h4>Torneo</h4>
                    <p>{{ $partido->torneo->nombre }} - {{ $partido->fecha->nombre }}</p>
                </div>
            </li>
        </ul>
    </section>

    @if ($partido->fechaPartido && $partido->horaPartido)
        <section class="informacion-clima">
            <h2>Clima del partido</h2>
            <ul class="datos-informacion-partido">
                @if ($clima)
                    <li>
                        <span class="card-icon weather">
                            <img src="https://openweathermap.org/img/wn/{{ data_get($clima, 'weather.0.icon') }}@4x.png"
                                alt="Clima" style="width: 72px; height: 72px; object-fit: contain;">
                        </span>
                        <div>
                            <h4>Estado</h4>
                            <p>{{ ucfirst(data_get($clima, 'weather.0.description')) }}</p>
                        </div>
                    </li>
                    <li>
                        <span class="card-icon weather">
                            <ion-icon name="thermometer-outline" class="material-icons"></ion-icon>
                        </span>
                        <div>
                            <h4>Temperatura</h4>
                            <p>{{ round(data_get($clima, 'temp.day'), 1) }}°C</p>
                        </div>
                    </li>
                    <li>
                        <span class="card-icon weather">
                            <ion-icon name="water-outline" class="material-icons"></ion-icon>
                        </span>
                        <div>
                            <h4>Humedad</h4>
                            <p>{{ data_get($clima, 'humidity') }}%</p>
                        </div>
                    </li>
                @else
                    <li>
                        <span class="card-icon weather">
                            <ion-icon name="help-circle-outline" class="material-icons"></ion-icon>
                        </span>
                        <div>
                            <h4>Aviso</h4>
                            <p>No disponible</p>
                        </div>
                    </li>
                @endif
            </ul>
        </section>
    @endif


    <article class="partido">

        <!-- Equipo Local -->
        <section class="equipo equipo-local">
            <header class="equipo-header">
                <figure class="equipo-escudo">
                    <img src="{{ asset('storage/' . $partido->local->escudo) }}"
                        alt="Escudo {{ $partido->local->nombre }}">
                </figure>
                <h2 class="equipo-nombre">{{ $partido->local->nombre }}</h2>
                <p class="equipo-condicion">Local</p>
            </header>
        </section>

        <!-- Resultado y estado -->
        <section class="partido-info">
                <span class="barra-estado {{ $partido->estado }}">
                    {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
                </span>

            @if ($partido->estado === 'programado')
                <span class="vs-text">VS</span>
            @else
                <p class="partido-resultado" aria-label="Resultado del partido">
                    <span class="goles-local">{{ $partido->goles_local ?? 0 }}</span>
                    <span class="separador">-</span>
                    <span class="goles-visitante">{{ $partido->goles_visitante ?? 0 }}</span>
                </p>
            @endif
        </section>

        <!-- Equipo Visitante -->
        <section class="equipo equipo-visitante">
            <header class="equipo-header">
                <figure class="equipo-escudo">
                    <img src="{{ asset('storage/' . $partido->visitante->escudo) }}"
                        alt="Escudo {{ $partido->visitante->nombre }}">
                </figure>
                <h2 class="equipo-nombre">{{ $partido->visitante->nombre }}</h2>
                <p class="equipo-condicion">Visitante</p>
            </header>
        </section>

    </article>

@endsection
