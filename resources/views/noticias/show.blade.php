@extends('layouts.app')

@section('title', 'Noticias')

@push('styles')
    @vite('resources/css/noticias/index.css')
@endpush

@section('content')

    <article class="noticia-detalle">

        <header class="noticia-header">
            <h1>{{ $noticia->titulo }}</h1>

            <div class="meta">
                @if ($noticia->fecha_publicacion)
                    <time datetime="{{ $noticia->fecha_publicacion->format('Y-m-d') }}">
                        {{ $noticia->fecha_publicacion->format('d M Y') }}
                    </time>
                @endif

                @if ($noticia->autor)
                    <span class="autor">Por {{ $noticia->autor }}</span>
                @endif

                <span class="visitas">
                    {{ $noticia->visitas }} visitas
                </span>
            </div>
        </header>

        @if ($noticia->imagen)
            <figure class="noticia-imagen-principal">
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
            </figure>
        @endif

        <section class="noticia-contenido">
            {!! nl2br(e($noticia->contenido)) !!}
        </section>

        <footer class="noticia-footer">
            <a href="{{ route('noticias.index') }}" class="volver">
                ← Volver a noticias
            </a>
        </footer>

    </article>

@endsection
