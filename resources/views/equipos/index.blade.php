@extends('layouts.app')

@section('title', 'Equipos')

@push('styles')
    @vite('resources/css/equipos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Equipos</h1>
    </header>

    <section class="equipos-container">

        @foreach ($equipos as $equipo)
            <a href="{{ route('equipos.show', $equipo->slug) }}" class="equipo-link">

                <article class="equipo-card">
                    <figure class="equipo-escudo">
                        <img src="{{ asset('storage/' . $equipo->escudo) }}" alt="Escudo {{ $equipo->nombre }}">
                    </figure>

                    <h2 class="equipo-nombre">{{ $equipo->nombre_pila }}</h2>

                </article>

            </a>
        @endforeach

    </section>


@endsection
