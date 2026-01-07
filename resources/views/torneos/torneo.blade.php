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
                <span class="card-icon">
                    <ion-icon name="alert-circle-outline" class="material-icons"></ion-icon>
                </span>
                <div>
                    <h4>Estado</h4>
                    <p>{{ $torneo->estado }}</p>
                </div>
            </article>
            <article>
                <span class="card-icon">
                    <ion-icon name="people-outline" class="material-icons"></ion-icon>
                </span>
                <div>

                    <h4>Equipos</h4>
                    <p>200 equipos</p>
                </div>
            </article>
            <article>
                <span class="card-icon">
                    <ion-icon name="calendar-outline" class="material-icons"></ion-icon>
                </span>
                <div>
                    <h4>Inicio</h4>
                    <p>{{ $torneo->fecha_inicio }}</p>
                </div>
            </article>
        </section>

        <section class="tabla-posiciones-torneo">
            <div class="data">
                <h2>
                    <ion-icon name="stats-chart-outline" class="icon"></ion-icon> Tabla de Posiciones
                </h2>
                <a href="{{ route('torneos.tabla', $torneo) }}" class="tabla-completa">Ver tabla completa <ion-icon
                        name="arrow-forward-outline"></ion-icon></a>
            </div>
            <x-tabla-posiciones :equipos="$tabla" limit="5" />
        </section>

        <section class="sobre-torneo">
            <h3>Sobre el torneo</h3>
            <p>{{ $torneo->descripcion }}</p>
        </section>

        <section class="partidos-torneo">
            <div class="data">
                <h2> <ion-icon name="football-outline" class="icon"></ion-icon> Partidos</h2>
                <a href="#" class="fixture-completo">Ver fixture completo <ion-icon
                        name="arrow-forward-outline"></ion-icon></a>
            </div>

            <section class="lista-partidos-torneo">
                @forelse ($proximosPartidos as $partido)
                    <x-partido-card :partido="$partido" />
                @empty
                    <p>No hay partidos para este torneo.</p>
                @endforelse

            </section>


        </section>
    </main>

@endsection
