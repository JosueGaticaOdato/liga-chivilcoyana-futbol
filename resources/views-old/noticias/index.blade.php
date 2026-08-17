@extends('layouts.app')

@section('title', 'Noticias')

@push('styles')
    @vite('resources/css/noticias/index.css')
@endpush

@section('content')

    <header class="header-main">
        <h1>Noticias</h1>
    </header>

    <section class="noticias">
        @forelse ($noticias as $noticia)
            <x-noticia-card :noticia="$noticia" />
        @empty
            <p>No hay noticias publicadas.</p>
        @endforelse
    </section>

@endsection
