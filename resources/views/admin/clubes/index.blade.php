@extends('admin.layouts.app')

@section('title', 'Clubes')
@section('page_title', 'Gestión de Clubes')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Clubes</span>
@endsection

@section('content')
<div class="space-y-6">

  {{-- Header with action button --}}
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Clubes Afiliados</h2>
      <p class="text-xs text-slate-500">Administra las instituciones, sus escudos, estadios y datos oficiales.</p>
    </div>
    <div class="flex items-center gap-2">
      <a
        href="{{ route('admin.equipos.index') }}"
        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
        <ion-icon name="people-outline" class="text-base text-[#59acda]"></ion-icon>
        Equipos por Categoría
      </a>
      <a
        href="{{ route('admin.clubes.create') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-all transform hover:-translate-y-0.5">
        <ion-icon name="add-circle-outline" class="text-lg"></ion-icon>
        Nuevo Club
      </a>
    </div>
  </div>

  {{-- Filter bar --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-xs">
    <form method="GET" action="{{ route('admin.clubes.index') }}" class="flex flex-col sm:flex-row gap-3">
      
      <div class="flex-1">
        <input
          type="text"
          name="buscar"
          value="{{ request('buscar') }}"
          placeholder="Buscar por nombre, nombre institucional o presidente..."
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
      </div>

      <div class="w-full sm:w-48">
        <select
          name="activo"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todos los estados</option>
          <option value="1" {{ request('activo') === '1' ? 'selected' : '' }}>Activos</option>
          <option value="0" {{ request('activo') === '0' ? 'selected' : '' }}>Inactivos</option>
        </select>
      </div>

      <div class="flex gap-2">
        <button
          type="submit"
          class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition-colors">
          Buscar
        </button>
        @if (request()->hasAny(['buscar', 'activo']))
          <a
            href="{{ route('admin.clubes.index') }}"
            class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
            Limpiar
          </a>
        @endif
      </div>

    </form>
  </div>

  {{-- Clubes Grid Cards --}}
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($clubes as $club)
      <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:border-[#59acda]/50 hover:shadow-md flex flex-col justify-between">
        
        <div>
          {{-- Card Header: Escudo + Name --}}
          <div class="flex items-start gap-3.5">
            <div class="h-14 w-14 shrink-0 rounded-xl bg-slate-100 p-1 border border-slate-200 flex items-center justify-center overflow-hidden">
              @if ($club->escudo)
                <img
                  src="{{ asset('storage/' . $club->escudo) }}"
                  alt="{{ $club->nombre }}"
                  class="h-full w-full object-contain">
              @else
                <ion-icon name="shield-outline" class="text-2xl text-slate-400"></ion-icon>
              @endif
            </div>

            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between gap-1">
                <h3 class="font-bold text-slate-900 text-base truncate">{{ $club->nombre }}</h3>
                @if ($club->activo)
                  <span class="inline-block h-2 w-2 rounded-full bg-emerald-500" title="Activo"></span>
                @else
                  <span class="inline-block h-2 w-2 rounded-full bg-slate-300" title="Inactivo"></span>
                @endif
              </div>
              <p class="text-xs text-slate-500 truncate" title="{{ $club->nombre_institucional }}">
                {{ $club->nombre_institucional }}
              </p>
              <p class="text-[11px] text-slate-400 font-mono mt-0.5">/{{ $club->slug }}</p>
            </div>
          </div>

          {{-- Details --}}
          <div class="mt-4 space-y-1.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
            <div class="flex items-center gap-1.5">
              <ion-icon name="location-outline" class="text-slate-400"></ion-icon>
              <span class="truncate">{{ $club->estadio->nombre ?? 'Sin estadio asignado' }}</span>
            </div>
            @if ($club->presidente)
              <div class="flex items-center gap-1.5">
                <ion-icon name="person-outline" class="text-slate-400"></ion-icon>
                <span class="truncate">Pres: {{ $club->presidente }}</span>
              </div>
            @endif
          </div>
        </div>

        {{-- Footer Actions --}}
        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-3">
          <a
            href="{{ route('clubes.show', $club->slug) }}"
            target="_blank"
            class="text-xs font-semibold text-[#59acda] hover:underline inline-flex items-center gap-1">
            <ion-icon name="eye-outline"></ion-icon>
            Ver perfil
          </a>

          <div class="inline-flex items-center gap-1">
            <a
              href="{{ route('admin.clubes.edit', $club) }}"
              title="Editar club"
              class="rounded-lg p-1.5 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
              <ion-icon name="create-outline" class="text-base"></ion-icon>
            </a>

            <form
              action="{{ route('admin.clubes.destroy', $club) }}"
              method="POST"
              onsubmit="return confirm('¿Estás seguro de eliminar el club {{ $club->nombre }}?');"
              class="inline">
              @csrf
              @method('DELETE')
              <button
                type="submit"
                title="Eliminar club"
                class="rounded-lg p-1.5 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                <ion-icon name="trash-outline" class="text-base"></ion-icon>
              </button>
            </form>
          </div>
        </div>

      </div>
    @empty
      <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-2xl border border-slate-200">
        <ion-icon name="shield-outline" class="text-4xl mb-2 text-slate-300"></ion-icon>
        <p class="font-medium">No se encontraron clubes registrados.</p>
      </div>
    @endforelse
  </div>

  @if ($clubes->hasPages())
    <div class="rounded-2xl border border-slate-200/80 bg-white px-5 py-4 shadow-xs">
      {{ $clubes->links() }}
    </div>
  @endif

</div>
@endsection
