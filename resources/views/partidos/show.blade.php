@extends('layouts.app')

@section('title', 'Partido')

@push('styles')
    @vite('resources/css/partidos/show.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>{{ $partido->local->nombre_pila }} vs {{ $partido->visitante->nombre_pila }}</h1>
    </header>

    <section class="informacion-partido">
        <h2>Datos del partido</h2>
        <ul class="data-game">
            <li><ion-icon name="calendar-outline"></ion-icon>
                {{ $partido->fecha_partido?->translatedFormat('d \d\e F, Y') }}
                -
                {{ \Carbon\Carbon::parse($partido->hora_partido)->format('H:i') }} Hs.
            </li>
            <li><ion-icon name="football-outline"></ion-icon>
                {{ $partido->cancha }}</li>
            <li class="partido">{{ $partido->torneo->nombre }} - {{ $partido->fecha->nombre }}</li>
            <li class="clima">Clima API</li>
        </ul>
    </section>

    <p>Estado: {{ $partido->estado }}</p>

    <h2>{{ $partido->goles_local }} - {{ $partido->goles_visitante }}</h2>

@endsection
