@extends('layouts.app')

@section('title', 'Tabla de posiciones - ' . $torneo->nombre)

@push('styles')
    @vite('resources/css/torneos/tabla.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>{{ $torneo->nombre }} {{ $torneo->temporada }}</h1>
        <p>Tabla de posiciones</p>
    </header>

    <section class="tabla-responsive">
        {{-- <h2>Tabla de Posiciones</h2> --}}
        <x-tabla-posiciones :equipos="$equipos" />
        <div class="informacion-torneo-tabla">
            <article class="criterio">
                <h3>Criterio de clasificacion</h3>
                <ul>
                    <li> <ion-icon name="checkmark-circle-outline"
                    class="check-icon"
                        ></ion-icon>Mayor cantidad de puntos obtenidos</li>
                    <li> <ion-icon name="checkmark-circle-outline" class="check-icon"></ion-icon>Mejor diferencia de gol</li>
                    <li> <ion-icon name="checkmark-circle-outline" class="check-icon"></ion-icon>Mayor cantidad de goles a favor</li>
                </ul>
            </article>
            <article class="referencias">
                <h3>Referencias</h3>
                <ul>
                    <li class="clasificado">Clasificado a PlayOff</li>
                </ul>
            </article>
        </div>
    </section>


@endsection
