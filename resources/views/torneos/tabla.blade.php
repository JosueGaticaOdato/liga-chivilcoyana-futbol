@extends('layouts.app')

@section('title', content: 'Tabla de posiciones - ' . $torneo->nombre . ' ' . $torneo->temporada->nombre)

@section('content')

<x-header-main title="Torneo {{ $torneo->nombre }} {{ $torneo->temporada->nombre }}" subtitle="Tabla de posiciones" />

{{-- NAVEGACIÓN DE SECCIONES DEL TORNEO --}}
<nav class="flex flex-wrap items-center justify-center gap-3 pb-4">
  <a href="{{ route('torneos.torneo', $torneo->slug) }}"
      class="flex items-center gap-2 rounded-xl bg-(--color-blanco) px-5 py-2.5 text-sm font-bold text-(--color-letras-primario) shadow-(--sombra-ultra-suave) transition-all duration-300 hover:bg-(--color-primario) hover:text-(--color-blanco) hover:shadow-(--sombra-suave)">
    <ion-icon name="information-circle-outline" class="text-lg"></ion-icon>
    Resumen
  </a>

  <a href="{{ route('torneos.tabla', $torneo->slug) }}"
      class="flex items-center gap-2 rounded-xl bg-(--color-primario) px-5 py-2.5 text-sm font-bold text-(--color-blanco) shadow-(--sombra-suave)">
    <ion-icon name="stats-chart-outline" class="text-lg"></ion-icon>
    Tabla de Posiciones
  </a>

  <a href="{{ route('torneos.fixture', $torneo->slug) }}"
      class="flex items-center gap-2 rounded-xl bg-(--color-blanco) px-5 py-2.5 text-sm font-bold text-(--color-letras-primario) shadow-(--sombra-ultra-suave) transition-all duration-300 hover:bg-(--color-primario) hover:text-(--color-blanco) hover:shadow-(--sombra-suave)">
    <ion-icon name="calendar-outline" class="text-lg"></ion-icon>
    Fixture
  </a>
</nav>

<section class="w-full flex flex-col gap-6 pb-8">

  @if ($tabla->isEmpty())
  <p>No hay datos de tabla disponibles.</p>
  @else

  <article>

    <div class="w-full overflow-x-auto [webkit-overflow-scrolling:touch]">
      <x-tabla-posiciones :equipos="$tabla" />
    </div>

  </article>


  <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 md:w-[90%] lg:w-[80%] mx-auto">

    <article class="bg-(--color-blanco) rounded-xl p-4 px-5">
      <h3 class="text-[1.1rem] md:text-[1.2rem] font-black pb-2 text-left">
        Criterio de clasificacion
      </h3>

      <ul class="flex flex-col gap-3 py-2">
        <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
          <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
          Mayor cantidad de puntos obtenidos
        </li>

        <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
          <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
          Mejor diferencia de gol
        </li>

        <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
          <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
          Mayor cantidad de goles a favor
        </li>
      </ul>
    </article>

    <article class="bg-(--color-blanco) rounded-xl p-4 px-5">
      <h3 class="text-[1.1rem] md:text-[1.2rem] font-black pb-2 text-left">
        Referencias
      </h3>

      <ul class="flex flex-col gap-3 py-2">
        <li class="clasificado flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base before:content-[''] before:w-3 before:h-3 before:bg-(--color-success) before:rounded-full lg:before:w-4 lg:before:h-4">
          Clasificado a PlayOff
        </li>
      </ul>
    </article>

  </div>
  @endif
</section>

@endsection