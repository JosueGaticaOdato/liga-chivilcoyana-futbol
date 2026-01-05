@extends('layouts.app')

@section('title', 'Torneos')

@push('styles')
    @vite('resources/css/torneos/torneo.css')
@endpush

@section('content')

    <section class="equipos-page">

        <header class="equipos-header">
            <h1>Torneos</h1>
        </header>

        <main class="equipos-container">

            @foreach ($torneos as $torneo)
                <a href="{{ route('torneos.tabla', $torneo->slug) }}" class="equipo-link">

                    <h2 class="equipo-nombre">{{ $torneo->nombre }}</h2>

                </a>
            @endforeach

        </main>

    </section>




@endsection
