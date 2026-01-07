@extends('layouts.app')

@section('title', 'Tabla de posiciones - ' . $torneo->nombre)

@push('styles')
    @vite('resources/css/torneos/tabla.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>{{ $torneo->nombre }} {{ $torneo->temporada }}</h1>
    </header>

    <section class="tabla-responsive">
        <x-tabla-posiciones :equipos="$equipos" />
    </section>


@endsection
