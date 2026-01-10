@extends('layouts.app')

@section('title', 'Partidos')

@push('styles')
    @vite('resources/css/partidos/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Partidos</h1>
    </header>

    {{-- Filtros --}}

    <form method="GET" class="filtros-partidos">

        <label for="categoria">Categoria
            <select name="categoria">

                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                        {{ $categoria }}
                    </option>
                @endforeach
            </select>
        </label>

        <label for="fecha">Fecha
            <input type="date" name="fecha" value="{{ request('fecha') }}">
        </label>

        <label for="estado">
            Estado
            <select name="estado">
                <option value="">Todos los estados</option>
                <option value="programado" {{ request('estado') == 'programado' ? 'selected' : '' }}>
                    Programado
                </option>
                <option value="en_juego" {{ request('estado') == 'en_juego' ? 'selected' : '' }}>
                    En juego
                </option>
                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>
            </select>
        </label>

        <button type="submit">Filtrar</button>
    </form>

    {{-- Lista de partidos --}}

    <section class="lista-partidos">

        @forelse ($partidos as $partido)
            <x-partido-card :partido="$partido" />
        @empty
            <p>No hay partidos para los filtros seleccionados.</p>
        @endforelse

    </section>




@endsection
