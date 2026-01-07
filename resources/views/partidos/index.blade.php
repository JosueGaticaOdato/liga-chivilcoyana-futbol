@extends('layouts.app')

@section('title', 'Partidos')

@push('styles')
    @vite('resources/css/partidos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Partidos</h1>
    </header>

    {{-- Filtros --}}

    <form method="GET" class="filtros-partidos">

        <label for="categoria">Categoria
            <select name="categoria">

                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                        {{ $categoria }}
                    </option>
                @endforeach
            </select>
        </label>

        <label for="fecha">Fecha
            <input type="date" name="fecha" value="{{ request('fecha') }}">
        </label>

        <label for="estado">
            Estado
            <select name="estado">
                <option value="">Todos los estados</option>
                <option value="programado" {{ request('estado') == 'programado' ? 'selected' : '' }}>
                    Programado
                </option>
                <option value="en_juego" {{ request('estado') == 'en_juego' ? 'selected' : '' }}>
                    En juego
                </option>
                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>
            </select>
        </label>

        <button type="submit">Filtrar</button>
    </form>

    {{-- Lista de partidos --}}

    <section class="lista-partidos">

        @forelse ($partidos as $partido)
            <article class="partido-card">

                <header class="partido-header">
                    <time datetime="2024-05-25 15:00">SAB 25 MAY | 15:00</time>
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
                        @if($partido->estado === 'programado')
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
                    <p>{{ $partido->cancha ?? "Estadio: A definir" }}</p>
                </footer>

            </article>

            {{-- <article class="match-card">
                <header class="card-header">
                    <time datetime="2024-05-25 15:00">SAB 25 MAY | 15:00</time>
                    <span class="status-badge live">En Vivo</span>
                </header>

                <div class="match-content">
                    <div class="team home">
                        <div class="logo-placeholder"></div> <h3 class="team-name">Equipo A</h3>
                    </div>

                    <div class="vs-divider">
                        <span>VS</span>
                    </div>

                    <div class="team away">
                        <div class="logo-placeholder"></div> <h3 class="team-name">Equipo B</h3>
                    </div>
                </div>

                <footer class="card-footer">
                    <p>Estadio Municipal</p>
                </footer>
            </article> --}}


            {{-- <article class="partido-card {{ $partido->estado }}">
                <div class="fecha">
                    {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                </div>

                <div class="equipos">
                    <span>{{ $partido->local->nombre_pila }}</span>
                    <strong>
                        {{ $partido->goles_local ?? '-' }}
                        :
                        {{ $partido->goles_visitante ?? '-' }}
                    </strong>
                    <span>{{ $partido->visitante->nombre_pila }}</span>
                </div>

                <div class="info">
                    <span>{{ ucfirst(str_replace('_', ' ', $partido->estado)) }}</span>
                    <span>{{ $partido->torneo->categoria }}</span>
                </div>

            </article> --}}

        @empty
            <p>No hay partidos para los filtros seleccionados.</p>
        @endforelse

    </section>




@endsection
