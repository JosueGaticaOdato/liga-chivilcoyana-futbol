@extends('layouts.redes')

@section('title', 'Tabla de posiciones - ' . $torneo->nombre)

@push('styles')
    @vite('resources/css/redes/tabla.css')
@endpush

@section('content')

    <main id="captura" class="main-captura">
        <header class="header-captura">
            <h1 class="titulo-tabla-captura">Tabla de posiciones</h1>
            <h2 class="liga-zona-captura">{{ $torneo->nombre }}</h2>

            @if ($zonaTorneo && $zonaTorneo->nombre != "General")
                <h3 class="zona-titulo-captura{{ $zonaTorneo->nombre == "General" ? "-general" : "" }}">
                    {{ $zonaTorneo->nombre }}
                </h3>
                {{-- TO-DO: Falta borrar el nombre de zona y que la tabla ocupe ese espacio --}}
            @endif

            <img class="logo-liga-captura" src="{{ asset('images/logo.png') }}"
            alt="Logo Liga Chivilcoyana de Futbol">
            <img class="logo-if-captura" src="{{ asset('images/logo-if.jpg') }}"
            alt="Logo IF Chivilcoy">
        </header>

        <table class="tabla-captura">
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Equipo</th>
                    <th>PTS</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PE</th>
                    <th>PP</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DIF</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tabla as $index => $equipoFase)
                    <tr>
                        <td>{{ $index + 1 }}°</td>

                        <td class="equipo">
                            <img src="{{ asset('storage/' . $equipoFase->equipo->escudo) }}" alt="Escudo {{ $equipoFase->equipo->nombre }}">
                            <span>{{ $equipoFase->equipo->nombre }}</span>
                        </td>

                        <td class="pts">{{ $equipoFase->puntos }}</td>
                        <td>{{ $equipoFase->partidos_jugados }}</td>
                        <td>{{ $equipoFase->ganados }}</td>
                        <td>{{ $equipoFase->empatados }}</td>
                        <td>{{ $equipoFase->perdidos }}</td>
                        <td>{{ $equipoFase->goles_favor }}</td>
                        <td>{{ $equipoFase->goles_contra }}</td>
                        <td>{{ $equipoFase->diferencia_goles }}</td>
                    </tr>
                @endforeach
            </tbody>


        </table>
    </main>
    {{-- <img class="ejemplo" src="{{ asset('images/ejemplo.png') }}"> --}}

    <button id="btn-descargar" style="margin-bottom: 20px; padding: 10px 20px;">
        Descargar Imagen para Redes
    </button>


    {{-- <header class="header-main">
        <h1>{{ $torneo->nombre }} {{ $torneo->temporada }}</h1>
        <p>Tabla de posiciones</p>
    </header>

    <section class="tabla-section">

        @foreach ($tablas as $item)
            <article>
                @if ($item['zona'] &&  $item['zona']->nombre != "General")
                    <h3 class="zona-titulo">
                        {{ $item['zona']->nombre }}
                    </h3>
                @endif

                <div class="tabla-scroll" id="captura-tabla">
                    <x-tabla-posiciones :equipos="$item['tabla']"/>
                </div>
            </article>
        @endforeach --}}

@endsection
