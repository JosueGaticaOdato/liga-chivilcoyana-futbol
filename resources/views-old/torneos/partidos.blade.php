@extends('layouts.app')

@section('title', 'Partidos - ' . $torneo->nombre)

@push('styles')
    @vite('resources/css/torneos/partidos.css')
@endpush

@section('content')
<section class="partidos-container">

    <header class="partidos-header">
        <h1>{{ $torneo->nombre }} – {{ $torneo->temporada }}</h1>
        <p>Categoría: {{ $torneo->categoria }}</p>
    </header>

    <div class="partidos-lista">

        @forelse ($partidos as $partido)

            <article class="partido-card">

                <div class="partido-info">
                    <span class="fecha">
                        {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                    </span>
                    <span class="hora">
                        {{ $partido->hora ? substr($partido->hora, 0, 5) : '' }}
                    </span>
                </div>

                <div class="partido-equipos">

                    <div class="equipo local">
                        <img src="{{ asset('storage/' . $partido->local->escudo) }}"
                             alt="Escudo {{ $partido->local->nombre }}">
                        <span>{{ $partido->local->nombre }}</span>
                    </div>

                    <div class="resultado">
                        @if ($partido->estado === 'finalizado')
                            <strong>{{ $partido->goles_local }} - {{ $partido->goles_visitante }}</strong>
                        @elseif ($partido->estado === 'en_juego')
                            <span class="en-vivo">EN JUEGO</span>
                        @else
                            <span class="vs">VS</span>
                        @endif
                    </div>

                    <div class="equipo visitante">
                        <img src="{{ asset('storage/' . $partido->visitante->escudo) }}"
                             alt="Escudo {{ $partido->visitante->nombre }}">
                        <span>{{ $partido->visitante->nombre }}</span>
                    </div>

                </div>

                @if ($partido->cancha)
                    <footer class="partido-cancha">
                        📍 {{ $partido->cancha }}
                    </footer>
                @endif

            </article>

        @empty
            <p>No hay partidos cargados para este torneo.</p>
        @endforelse

    </div>

</section>
@endsection
