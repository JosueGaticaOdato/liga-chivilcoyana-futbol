@extends('admin.layouts.app')

@section('title', 'Editar Equipo')
@section('page_title', 'Editar Equipo')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.equipos.index') }}" class="hover:text-[#59acda] transition-colors">Equipos</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Editar</span>
@endsection

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Editar Equipo: {{ $equipo->nombre }}</h2>
      <p class="text-xs text-slate-500">Modifica el club, categoría o estado del plantel.</p>
    </div>
    <a
      href="{{ route('admin.equipos.index') }}"
      class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
      <ion-icon name="arrow-back-outline"></ion-icon>
      Volver al listado
    </a>
  </div>

  {{-- Form Card --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-xs">
    <form action="{{ route('admin.equipos.update', $equipo) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="space-y-5">
        
        {{-- Club --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Club <span class="text-rose-500">*</span>
          </label>
          <select
            name="club_id"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all @error('club_id') border-rose-400 @enderror">
            @foreach ($clubes as $club)
              <option value="{{ $club->id }}" {{ old('club_id', $equipo->club_id) == $club->id ? 'selected' : '' }}>
                {{ $club->nombre }} ({{ $club->nombre_institucional }})
              </option>
            @endforeach
          </select>
          @error('club_id')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Categoria --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Categoría / División <span class="text-rose-500">*</span>
          </label>
          <select
            name="categoria_id"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all @error('categoria_id') border-rose-400 @enderror">
            @foreach ($categorias as $cat)
              <option value="{{ $cat->id }}" {{ old('categoria_id', $equipo->categoria_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
              </option>
            @endforeach
          </select>
          @error('categoria_id')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nombre especifico (opcional) --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Nombre del Equipo en el Torneo
          </label>
          <input
            type="text"
            name="nombre"
            value="{{ old('nombre', $equipo->nombre) }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Activo checkbox --}}
        <div class="flex items-center gap-2 pt-2">
          <input
            type="checkbox"
            name="activo"
            id="activo"
            value="1"
            {{ old('activo', $equipo->activo) ? 'checked' : '' }}
            class="h-4 w-4 rounded border-slate-300 text-[#59acda] focus:ring-[#59acda]">
          <label for="activo" class="text-sm font-medium text-slate-700 cursor-pointer">
            Equipo habilitado para competir
          </label>
        </div>

      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a
          href="{{ route('admin.equipos.index') }}"
          class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
          Cancelar
        </a>
        <button
          type="submit"
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
          <ion-icon name="save-outline" class="text-lg"></ion-icon>
          Actualizar Equipo
        </button>
      </div>

    </form>
  </div>

</div>
@endsection
