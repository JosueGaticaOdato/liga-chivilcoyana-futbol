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

    <section class="tabla-section">
        {{-- <h2>Tabla de Posiciones</h2> --}}

        @if ($tablas->isEmpty())
            <p>No hay datos de tabla disponibles.</p>
        @endif

        @foreach ($tablas as $item)
            <article>
                {{-- Si hay zonas, mostrar nombre --}}
                @if ($item['zona'] &&  $item['zona']->nombre != "General")
                    {{-- TO-DO manejar la tabla general desde el front o hacer algo en como viene de la BD --}}
                    <h3 class="zona-titulo">
                        {{ $item['zona']->nombre }}
                    </h3>
                @endif

                <x-tabla-posiciones :equipos="$item['tabla']" limit="4"/>
            </article>
        @endforeach

        {{--
        <div class="tabla-scroll">
            <x-tabla-posiciones :equipos="$equipos" />
        </div>
        --}}

        <div class="informacion-torneo-tabla">
            <article class="criterio">
                <h3>Criterio de clasificacion</h3>
                <ul>
                    <li> <ion-icon name="checkmark-circle-outline" class="check-icon"></ion-icon>Mayor cantidad de puntos
                        obtenidos</li>
                    <li> <ion-icon name="checkmark-circle-outline" class="check-icon"></ion-icon>Mejor diferencia de gol
                    </li>
                    <li> <ion-icon name="checkmark-circle-outline" class="check-icon"></ion-icon>Mayor cantidad de goles a
                        favor</li>
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
