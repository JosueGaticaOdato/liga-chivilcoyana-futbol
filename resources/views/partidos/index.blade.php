@extends('layouts.app')

@section('title', 'Partidos')

@push('styles')
@vite('resources/css/partidos/index.css')
@endpush

@section('content')

  <x-header-main title="Partidos" />

  {{-- Filtros --}}

  {{-- <form method="GET" class="grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr_0.5fr] items-center gap-6 md:gap-8 w-full p-4 md:px-8 lg:px-16 rounded-2xl">

      <label for="categoria" class="flex flex-col gap-2 w-full text-base font-bold">
          Categoria
          <select name="categoria" class="w-full p-2 box-border rounded-lg font-normal bg-(--color-blanco) border border-(--color-cuaternario)">
              <option value="">Todas las categorías</option>
              @foreach ($categorias as $categoria)
                  <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
  {{ $categoria }}
  </option>
  @endforeach
  </select>
  </label>

  <label for="fecha" class="flex flex-col gap-2 w-full text-base font-bold">
    Fecha
    <input type="date" name="fecha" value="{{ request('fecha') }}" class="w-full p-2 box-border rounded-lg font-normal bg-(--color-blanco) border border-(--color-cuaternario)">
  </label>

  <label for="estado" class="flex flex-col gap-2 w-full text-base font-bold">
    Estado
    <select name="estado" class="w-full p-2 box-border rounded-lg font-normal bg-(--color-blanco) border border-(--color-cuaternario)">
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

  <button type="submit" class="w-full lg:w-1/2 mx-auto p-2 rounded-lg bg-(--color-primario) text-(--color-letras-secundario) text-[1.1rem] font-black border-0 cursor-pointer transition-[background,color] duration-300 ease-in-out lg:hover:bg-(--color-letras-secundario) lg:hover:text-(--color-primario) lg:hover:border lg:hover:border-(--color-primario)">
    Filtrar
  </button>

  </form> --}}

  {{-- Lista de partidos --}}

  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center gap-[1.2rem] p-8">

    @forelse ($partidos as $partido)
    <x-partido-card :partido="$partido" />
    @empty
    <p>No hay partidos para los filtros seleccionados.</p>
    @endforelse

  </section>

@endsection