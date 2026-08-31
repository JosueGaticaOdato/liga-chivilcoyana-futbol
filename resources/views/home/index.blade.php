@extends('layouts.app')

@section('title', 'Liga Chivilcoyana de Futbol')

@section('content')

<x-header-main title="Liga Chivilcoyana de Futbol" subtitle="Seguí los resultados, tablas y noticias del fútbol local." />

<section class="max-w-300 my-12 mx-auto px-6 flex flex-col lg:grid lg:grid-cols-[2fr_1fr] lg:gap-8">

    <!-- RESUMEN DE PARTIDOS -->
    <section aria-labelledby="partidos-title">
        <h2 id="partidos-title" class="text-xl font-extrabold mb-5">
            Partidos
        </h2>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(15rem,1fr))] gap-4">
            @forelse ($partidosRecientes as $partido)
                <x-partido-card :partido="$partido" />
            @empty
                <p>No hay partidos para este torneo.</p>
            @endforelse
        </div>

        <a href="{{ route('partidos.index') }}" class="inline-block mt-4 py-8 text-base font-bold text-(--color-primario) lg:hover:underline">
            Ver todos los partidos
        </a>
    </section>


    <!-- TABLAS DE POSICIONES -->
    <aside>
        <h2 class="text-lg font-extrabold">
            {{ $torneo->nombre }} {{ $torneo->temporada->nombre }} - Tabla
        </h2>

        @if ($tabla->isEmpty())
            <p>No hay datos de tabla disponibles.</p>
        @else
        
        <div class="w-full overflow-x-auto [webkit-overflow-scrolling:touch]">
          <x-tabla-posiciones :equipos="$tabla" :limit="$cant_equipos_tabla" variant="simple" />
        </div>
        @endif

        <a href="{{ route('torneos.tabla', $torneo->slug) }}" class="inline-block mt-4 py-8 text-base font-bold text-(--color-primario) lg:hover:underline">
            Ver tabla completa
        </a>
    </aside>

</section>


<!-- NOTICIAS -->
@isset($noticias)
<section class="max-w-300 my-12 mx-auto px-6">
    <h2 class="text-xl font-extrabold mb-5">
        Noticias Recientes
    </h2>

    <div class="flex flex-wrap gap-8 justify-center items-center pb-8">
        @forelse ($noticias as $noticia)
            <x-noticia-card :noticia="$noticia" />
        @empty
            <p>No hay noticias publicadas.</p>
        @endforelse
    </div>

    <a href="{{ route('noticias.index') }}" class="inline-block mt-4 py-8 text-base font-bold text-(--color-primario) lg:hover:underline">
        Ver toodas las noticias
    </a>
</section>
@endisset

@endsection
