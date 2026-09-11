@extends('layouts.app')

@section('title', 'Fixture - Torneo ' . $torneo->nombre . ' ' . $torneo->temporada->nombre)

@section('content')

{{-- HEADER --}}
<x-header-main title="Torneo {{ $torneo->nombre }} {{ $torneo->temporada->nombre }}" subtitle="Fixture" />

<div class="mx-4 flex flex-col gap-8 pb-12 lg:mx-40">

  {{-- NAVEGACIÓN DE SECCIONES DEL TORNEO --}}
  <nav class="flex flex-wrap items-center justify-center gap-3">
    <a href="{{ route('torneos.torneo', $torneo->slug) }}"
       class="flex items-center gap-2 rounded-xl bg-(--color-blanco) px-5 py-2.5 text-sm font-bold text-(--color-letras-primario) shadow-(--sombra-ultra-suave) transition-all duration-300 hover:bg-(--color-primario) hover:text-(--color-blanco) hover:shadow-(--sombra-suave)">
      <ion-icon name="information-circle-outline" class="text-lg"></ion-icon>
      Resumen
    </a>

    <a href="{{ route('torneos.tabla', $torneo->slug) }}"
       class="flex items-center gap-2 rounded-xl bg-(--color-blanco) px-5 py-2.5 text-sm font-bold text-(--color-letras-primario) shadow-(--sombra-ultra-suave) transition-all duration-300 hover:bg-(--color-primario) hover:text-(--color-blanco) hover:shadow-(--sombra-suave)">
      <ion-icon name="stats-chart-outline" class="text-lg"></ion-icon>
      Tabla de Posiciones
    </a>

    <a href="{{ route('torneos.fixture', $torneo->slug) }}"
       class="flex items-center gap-2 rounded-xl bg-(--color-primario) px-5 py-2.5 text-sm font-bold text-(--color-blanco) shadow-(--sombra-suave)">
      <ion-icon name="calendar-outline" class="text-lg"></ion-icon>
      Fixture
    </a>
  </nav>

  @if ($jornadas->isEmpty())
    {{-- ESTADO VACÍO CUANDO NO HAY JORNADAS/PARTIDOS --}}
    <section class="flex flex-col items-center justify-center gap-4 rounded-2xl bg-(--color-blanco) p-12 text-center shadow-(--sombra-suave)">
      <span class="flex h-20 w-20 items-center justify-center rounded-full bg-(--color-fondo-iconos) text-(--color-primario)">
        <ion-icon name="calendar-clear-outline" class="text-4xl"></ion-icon>
      </span>

      <h3 class="text-xl font-bold text-(--color-letras-primario)">
        No hay partidos programados
      </h3>

      <p class="max-w-md text-sm text-(--color-letras-terceario)">
        El fixture para el Torneo {{ $torneo->nombre }} aún no ha sido cargado o no cuenta con fechas disponibles.
      </p>

      <a href="{{ route('torneos.torneo', $torneo->slug) }}"
         class="mt-2 inline-flex items-center gap-2 rounded-lg bg-(--color-primario) px-6 py-2.5 text-sm font-bold text-(--color-blanco) transition-all hover:brightness-110">
        <ion-icon name="arrow-back-outline"></ion-icon>
        Volver al torneo
      </a>
    </section>
  @else

    {{-- SELECTOR DE JORNADAS (FECHAS) --}}
    <section class="flex flex-col gap-4 rounded-2xl bg-(--color-blanco) p-6 shadow-(--sombra-suave)">
      <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
        <h2 class="flex items-center gap-2 text-lg font-extrabold text-(--color-letras-primario)">
          <ion-icon name="calendar-number-outline" class="text-xl text-(--color-primario)"></ion-icon>
          Seleccionar Fecha
        </h2>
      </div>

      {{-- LISTADO DE PÍLDORAS DE FECHAS CON SCROLL HORIZONTAL --}}
      <nav class="flex gap-2 overflow-x-auto pb-2 pt-1 [webkit-overflow-scrolling:touch]">
        @foreach ($jornadas as $jornada)
          @php
            $esActiva = ($jornada === $jornadaActual);
          @endphp
          <a href="{{ route('torneos.fixture', [$torneo->slug, $jornada]) }}"
             class="shrink-0 rounded-xl px-5 py-2.5 text-sm font-bold transition-all duration-200 {{ $esActiva ? 'bg-linear-to-r from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco) shadow-(--sombra-suave) ring-2 ring-(--color-primario)' : 'border border-(--color-stay) bg-(--color-blanco) text-(--color-letras-terceario) hover:border-(--color-primario) hover:text-(--color-primario)' }}">
            Fecha {{ $jornada }}
          </a>
        @endforeach
      </nav>
    </section>

    {{-- LISTADO DE PARTIDOS DE LA FECHA SELECCIONADA --}}
    <section class="flex flex-col gap-6">

      <div class="flex items-center justify-between px-2">
        <h3 class="flex items-center gap-2 text-2xl font-black text-(--color-letras-primario)">
          <span>Fecha {{ $jornadaActual }}</span>
          <span class="rounded-full bg-(--color-primario) px-3 py-0.5 text-xs font-bold text-(--color-blanco)">
            {{ $partidos->count() }} {{ $partidos->count() === 1 ? 'partido' : 'partidos' }}
          </span>
        </h3>
      </div>

      @if ($partidos->isEmpty())
        <div class="rounded-2xl bg-(--color-blanco) p-8 text-center text-(--color-letras-terceario) shadow-(--sombra-ultra-suave)">
          No hay partidos programados para la Fecha {{ $jornadaActual }}.
        </div>
      @else
        <div class="grid grid-cols-1 justify-items-center gap-6 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($partidos as $partido)
            <x-partido-card :partido="$partido" />
          @endforeach
        </div>
      @endif

    </section>

  @endif

</div>

@endsection
