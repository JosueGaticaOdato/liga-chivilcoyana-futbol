@extends('layouts.app')

@section('title', 'Equipos')

@push('styles')
    @vite('resources/css/equipos/index.css')
@endpush

@section('content')

    <section class="equipos-page">

        <header class="equipos-header">
            <h1>Equipos</h1>
        </header>

        <main class="equipos-container">

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

        </main>

    </section>


@endsection
