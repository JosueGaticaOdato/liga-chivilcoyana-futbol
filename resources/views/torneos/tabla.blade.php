@extends('layouts.app')

@section('title', 'Tabla de posiciones - ' . $torneo->nombre)

@push('styles')
    @vite('resources/css/torneos/torneo.css')
@endpush

@section('content')

<section class="tabla-container">

    <header class="tabla-header">
        <h1>{{ $torneo->nombre }} – {{ $torneo->temporada }}</h1>
        <p>Categoría: {{ $torneo->categoria }}</p>
    </header>

    <table class="tabla-posiciones">
        <thead>
            <tr>
                <th>#</th>
                <th>Equipo</th>
                <th>PJ</th>
                <th>G</th>
                <th>E</th>
                <th>P</th>
                <th>GF</th>
                <th>GC</th>
                <th>DG</th>
                <th>Pts</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($equipos as $index => $equipo)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="equipo">
                        <img
                            src="{{ asset('storage/' . $equipo->escudo) }}"
                            alt="Escudo {{ $equipo->nombre_pila }}"
                        >
                        <span>{{ $equipo->nombre_pila }}</span>
                    </td>
                    <td>{{ $equipo->pivot->partidos_jugados }}</td>
                    <td>{{ $equipo->pivot->ganados }}</td>
                    <td>{{ $equipo->pivot->empatados }}</td>
                    <td>{{ $equipo->pivot->perdidos }}</td>
                    <td>{{ $equipo->pivot->goles_favor }}</td>
                    <td>{{ $equipo->pivot->goles_contra }}</td>
                    <td>{{ $equipo->pivot->diferencia_goles }}</td>
                    <td class="pts">{{ $equipo->pivot->puntos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</section>


@endsection
