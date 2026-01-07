@extends('layouts.app')

@section('title', 'Torneos')

@push('styles')
    @vite('resources/css/torneos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Torneos</h1>
    </header>


    <section class="torneos-section">

        {{-- <h2>Competiciones disponibles</h2>
        <p>Explora todas las divisiones y copas de la temporada</p> --}}

        <!-- TO-DO Filtro por categoria -->

        <ul class="torneos-container">
            @foreach ($torneos as $torneo)
                <li><a href="{{ route('torneos.torneo', $torneo->slug) }}" class="torneo-card">
                        <article class="card-contenedor">
                            <figure class="card-icon">
                                <ion-icon name="trophy-outline" class="material-icons"></ion-icon>
                            </figure>

                            <section class="card-details">
                                <span class="barra-status status-{{ $torneo->estado }}">{{ $torneo->estado == 'activo' ? 'En Curso' : 'Finalizado' }}</span>
                                <h3 class="card-title">{{ $torneo->nombre }} {{ $torneo->temporada }}</h3>
                                <p class="card-subtitle">Categoria: {{ $torneo->categoria }}</p>
                            </section>
                        </article>
                    </a>
                </li>
            @endforeach
        </ul>

    </section>

@endsection
