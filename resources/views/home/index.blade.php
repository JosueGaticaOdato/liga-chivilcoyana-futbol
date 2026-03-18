@extends('layouts.app')

@section('title', 'Liga Chivilcoyana de Futbol')

@push('styles')
    @vite('resources/css/home/index.css')
@endpush

@section('content')

    <section class="header-home">
        <h1>Tu fútbol, tu ciudad,<br>todas las divisiones.</h1>
        <p>Seguí los resultados, tablas y noticias del fútbol local.</p>

        <a href="{{ route('partidos.index') }}"class="boton-proximos-partidos">
            Ver próximos partidos
        </a>
    </section>

    <section class="home">

        <!-- RESUMEN DE PARTIDOS -->
        {{-- <section class="partidos-recientes" aria-labelledby="partidos-title">
            <h2 id="partidos-title">Resumen de Partidos</h2>

            <div class="partidos-lista">
                @forelse ($partidosRecientes as $partido)
                    <x-partido-card :partido="$partido" />
                @empty
                    <p>No hay partidos para este torneo.</p>
                @endforelse
            </div>

            <a href="{{ route('partidos.index') }}" class="link-mas">
                Ver todos los partidos
            </a>
        </section>

        <!-- TABLAS DE POSICIONES -->
        <aside class="tablas-posiciones">
            <h2>Primera Division - Tabla</h2>

            <x-tabla-posiciones :equipos="$tabla" limit="8" variant="simple" />

            <a href="{{ route('torneos.torneo', $torneo->slug) }}" class="link-mas">
                Ver tabla completa
            </a>
        </aside> --}}

    </section>

    <!-- NOTICIAS -->
    <section class="noticias-recientes">
        <h2>Noticias Recientes</h2>

        <div class="noticias-list">
            @forelse ($noticias as $noticia)
                <x-noticia-card :noticia="$noticia" />
            @empty
                <p>No hay noticias publicadas.</p>
            @endforelse
        </div>

        <a href="{{ route('noticias.index') }}" class="link-mas">
            Ver toodas las noticias
        </a>
    </section>
@endsection
