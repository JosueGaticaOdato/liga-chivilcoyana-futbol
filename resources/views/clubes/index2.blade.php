@extends('layouts.app2')

@section('title', 'Clubes')

@push('styles')
    @vite('resources/css-old/equipos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Clubes</h1>
    </header>

    <section class="equipos-container">

        @foreach ($clubes as $club)
            <a href="{{ route('clubes.show', $club->slug) }}" class="equipo-link">

                <article class="equipo-card">
                    <figure class="equipo-escudo">
                        <img src="{{ asset('storage/' . $club->escudo) }}" alt="Escudo {{ $club->nombre }}">
                    </figure>

                    <h2 class="equipo-nombre">{{ $club->nombre }}</h2>

                </article>

            </a>
        @endforeach

    </section>


@endsection