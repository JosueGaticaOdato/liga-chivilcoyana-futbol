@extends('layouts.app')

@section('title', 'Torneos')

@push('styles')
    @vite('resources/css/torneos/fixture.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Fixture Completo</h1>
        <p>{{ $torneo->nombre }}</p>
    </header>

    <section class="fixture-fechas">
        <h2>Fechas: </h2>
        <nav class="fechas">
            @foreach ($fechas as $fecha)
                <a href="{{ route('torneos.fixture', [$torneo->slug, $fecha->numero]) }}"
                    class="{{ $fecha->id === $fechaActual->id ? 'activa' : '' }}">
                    {{ $fecha->numero }}
                </a>
            @endforeach
        </nav>
    </section>

    {{-- PARTIDOS --}}
    <section class="fixture-partidos">
        <h3>{{ $fechaActual->nombre }}</h3>
        <div class="lista-fixture-partidos">
            @forelse ($fechaActual->partidos as $partido)
            <x-partido-card :partido="$partido" />
            @empty
            <p>No hay partidos aun para esta fecha.</p>
            @endforelse
        </div>
    </section>

@endsection
