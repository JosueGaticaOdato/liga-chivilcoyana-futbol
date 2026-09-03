@extends('layouts.app')

@section('title', content: 'Torneo ' . $torneo->nombre . ' ' . $torneo->temporada->nombre)

@section('content')

{{-- HEADER --}}
<x-header-main title="Torneo {{ $torneo->nombre }} {{ $torneo->temporada->nombre }}" />

<main class="mx-4 flex flex-col gap-8 lg:mx-40 lg:grid lg:grid-cols-5">

  {{-- ========================================= --}}
  {{-- INFORMACIÓN DEL TORNEO --}}
  {{-- ========================================= --}}

  <section class="flex flex-col gap-6 rounded-xl border-l-8 border-b-4 border-l-(--color-primario) border-b-transparent bg-(--color-blanco) p-6 shadow-(--sombra-ultra-suave) md:flex-row md:justify-around lg:col-span-5">

    {{-- ESTADO --}}
    <article class="flex items-center gap-4">

      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="alert-circle-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="pb-1 text-[0.9rem] font-bold uppercase text-(--color-letras-cuaternario)">
          Estado
        </h4>

        <p class="flex items-center gap-1.5 text-base font-extrabold">
          <span class="h-[0.7rem] w-[0.7rem] rounded-full {{ $torneo->estado === 'en_curso' ? 'bg-(--color-success)' : 'bg-(--color-error)' }}"></span>

          {{ $torneo->estado == 'en_curso' ? 'En Curso' : 'Finalizado' }}
        </p>
      </div>

    </article>


    {{-- EQUIPOS --}}
    <article class="flex items-center gap-4">

      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="people-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="pb-1 text-[0.9rem] font-bold uppercase text-(--color-letras-cuaternario)">
          Equipos
        </h4>

        <p class="text-base font-extrabold">
          {{ $cantidadEquipos }} equipos
        </p>
      </div>

    </article>


    {{-- INICIO --}}
    <article class="flex items-center gap-4">

      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="calendar-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="pb-1 text-[0.9rem] font-bold uppercase text-(--color-letras-cuaternario)">
          Inicio
        </h4>

        <p class="text-base font-extrabold">
          {{ $torneo->fecha_inicio->translatedFormat('d \d\e F \d\e Y') }}
        </p>
      </div>

    </article>


    {{-- FINAL --}}
    @isset($torneo->fecha_fin)

    <article class="flex items-center gap-4">

      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="calendar-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="pb-1 text-[0.9rem] font-bold uppercase text-(--color-letras-cuaternario)">
          Final
        </h4>

        <p class="text-base font-extrabold">
          {{ $torneo->fecha_fin->translatedFormat('d \d\e F \d\e Y') }}
        </p>
      </div>

    </article>

    @endisset

  </section>


  {{-- ========================================= --}}
  {{-- TABLA DE POSICIONES --}}
  {{-- ========================================= --}}

  <section class="w-full lg:col-span-4 lg:row-span-2 lg:row-start-2">

    <div class="flex flex-col items-center justify-between gap-4 p-4 md:flex-row md:gap-0">

      <h2 class="flex items-center gap-3 text-[1.4rem] font-extrabold md:text-[1.6rem]">
        <ion-icon name="stats-chart-outline" class="text-[1.5rem] text-(--color-primario)"></ion-icon>

        Tabla de Posiciones
      </h2>


      @if (!$tabla->isEmpty())
      <a href="{{ route('torneos.tabla', $torneo) }}" class="flex items-center gap-2 text-base text-(--color-links) transition-all duration-300 lg:hover:border-b lg:hover:border-(--color-links) lg:hover:text-[1.1rem]">
        Ver tabla completa

        <ion-icon name="arrow-forward-outline"></ion-icon>
      </a>
      @endif

    </div>


    @if ($tabla->isEmpty())

    <p class="flex items-center justify-center py-6 text-(--color-letras-terceario)">
      No hay datos de tabla disponibles.
    </p>

    @else
    
    <article>
      
      <div class="w-full overflow-x-auto [webkit-overflow-scrolling:touch]">
        <x-tabla-posiciones :equipos="$tabla" :limit="$limite" variant="simple" />
      </div>
      
    </article>

    @endif

  </section>


  {{-- ========================================= --}}
  {{-- SOBRE EL TORNEO --}}
  {{-- ========================================= --}}

  <section class="flex flex-col gap-4 rounded-2xl bg-(--color-blanco) p-4 lg:col-start-5 lg:row-start-2">

    <h3 class="border-b border-(--color-secundario) pb-3 text-left text-[1.4rem]">
      Sobre el torneo
    </h3>

    <p class="text-[0.95rem] leading-[1.3rem] text-(--color-letras-terceario)">
      {{ $torneo->descripcion }}
    </p>

  </section>


  {{-- ========================================= --}}
  {{-- PARTIDOS --}}
  {{-- ========================================= --}}

  <section class="w-full lg:col-span-5 lg:row-span-2 lg:row-start-4">

    <div class="flex flex-col items-center justify-between gap-4 p-4 md:flex-row md:gap-0">

      <h2 class="flex items-center gap-3 text-[1.4rem] font-extrabold md:text-[1.6rem]">
        <ion-icon name="football-outline" class="text-[1.5rem] text-(--color-primario)"></ion-icon>Partidos
      </h2>

      @if (!$tabla->isEmpty())
      <a href="{{ route('torneos.fixture', $torneo->slug) }}" class="flex items-center gap-2 text-base text-(--color-links) transition-all duration-300 lg:hover:border-b lg:hover:border-(--color-links) lg:hover:text-[1.1rem]">
        Ver fixture completo
        <ion-icon name="arrow-forward-outline"></ion-icon>
      </a>
      @endif

    </div>


    @if ($partidos->isEmpty())

    <p class="flex items-center justify-center py-6 text-(--color-letras-terceario)">
      No hay partidos para este torneo.
    </p>

    @else

    <section class="grid grid-cols-1 justify-items-center gap-[1.2rem] pb-8 md:grid-cols-2 lg:grid-cols-3">

      @foreach ($partidos as $partido)
        <x-partido-card :partido="$partido" />
      @endforeach

    </section>

    @endif

  </section>

</main>

@endsection