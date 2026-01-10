@extends('layouts.app')

@section('title', 'Liga Chivilcoyana de Futbol')

@push('styles')
    @vite('resources/css/home/index.css')
@endpush

@section('content')
    <section class="carrusel">
        <h1>PAGINA DE INICIO</h1>
    </section>

    <section class="tabla-posiciones">
        <h2>Tabla de posiciones</h2>
    </section>

    <section class="proximos-partidos">
        <h2>Proximos Partidos</h2>
    </section>

    <section class="noticias-recientes">
        <h2>Noticias recientes</h2>
    </section>
@endsection
