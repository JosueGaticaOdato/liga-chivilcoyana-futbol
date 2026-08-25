@extends('layouts.app2')

@section('title', 'Torneos')

@push('styles')
    @vite('resources/css-old/torneos/index.css')
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
                            <span class="card-icon">
                                <ion-icon name="trophy-outline" class="material-icons"></ion-icon>
                            </span>

                            <section class="card-details">
                                <span class="barra-status status-{{ $torneo->estado }}">{{ $torneo->estado == 'en_curso' ? 'En Curso' : 'Finalizado' }}</span>
                                <h3 class="card-title">{{ $torneo->nombre }} {{ $torneo->temporada->nombre }}</h3>
                                <p class="card-subtitle">Categoria: {{ $torneo->categoria->nombre }}</p>
                            </section>
                        </article>
                    </a>
                </li>
            @endforeach
        </ul>

    </section>

@endsection
