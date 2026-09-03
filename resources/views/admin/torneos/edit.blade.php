@extends('admin.layouts.app')

@section('title', 'Editar Torneo')
@section('page_title', 'Editar Torneo')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.torneos.index') }}" class="hover:text-[#59acda] transition-colors">Torneos</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Editar</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Editar Torneo: {{ $torneo->nombre }}</h2>
      <p class="text-xs text-slate-500">Actualiza las fechas, categoría o estado de la competencia.</p>
    </div>
    <a
      href="{{ route('admin.torneos.index') }}"
      class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
      <ion-icon name="arrow-back-outline"></ion-icon>
      Volver al listado
    </a>
  </div>

  {{-- Form Card --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-xs">
    <form action="{{ route('admin.torneos.update', $torneo) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        
        {{-- Nombre --}}
        <div class="sm:col-span-2">
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Nombre del Torneo <span class="text-rose-500">*</span>
          </label>
          <input
            type="text"
            name="nombre"
            value="{{ old('nombre', $torneo->nombre) }}"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all @error('nombre') border-rose-400 @enderror">
          @error('nombre')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Temporada --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Temporada <span class="text-rose-500">*</span>
          </label>
          <select
            name="temporada_id"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all @error('temporada_id') border-rose-400 @enderror">
            @foreach ($temporadas as $temp)
              <option value="{{ $temp->id }}" {{ old('temporada_id', $torneo->temporada_id) == $temp->id ? 'selected' : '' }}>
                {{ $temp->nombre }} {{ $temp->activa ? '(Activa)' : '' }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Categoria --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Categoría <span class="text-rose-500">*</span>
          </label>
          <select
            name="categoria_id"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all @error('categoria_id') border-rose-400 @enderror">
            @foreach ($categorias as $cat)
              <option value="{{ $cat->id }}" {{ old('categoria_id', $torneo->categoria_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Fecha Inicio --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Fecha de Inicio
          </label>
          <input
            type="date"
            name="fecha_inicio"
            value="{{ old('fecha_inicio', $torneo->fecha_inicio ? $torneo->fecha_inicio->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Fecha Fin --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Fecha de Finalización
          </label>
          <input
            type="date"
            name="fecha_fin"
            value="{{ old('fecha_fin', $torneo->fecha_fin ? $torneo->fecha_fin->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Estado --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Estado de la Competencia <span class="text-rose-500">*</span>
          </label>
          <select
            name="estado"
            required
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
            <option value="planificado" {{ old('estado', $torneo->estado) === 'planificado' ? 'selected' : '' }}>Planificado</option>
            <option value="en_curso" {{ old('estado', $torneo->estado) === 'en_curso' ? 'selected' : '' }}>En Curso (Activo)</option>
            <option value="finalizado" {{ old('estado', $torneo->estado) === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
          </select>
        </div>

        {{-- Slug --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Slug / Identificador URL
          </label>
          <input
            type="text"
            name="slug"
            value="{{ old('slug', $torneo->slug) }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Descripcion --}}
        <div class="sm:col-span-2">
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Descripción / Reglamento
          </label>
          <textarea
            name="descripcion"
            rows="3"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">{{ old('descripcion', $torneo->descripcion) }}</textarea>
        </div>

        {{-- Formato de la Primera Fase --}}
        <div class="sm:col-span-2">

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Tipo de Competición
              </label>
              <select
                name="tipo_fase"
                id="tipo_fase_select"
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-[#59acda] focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
                <option value="round_robin" {{ old('tipo_fase', $primeraFase?->tipo ?? 'round_robin') === 'round_robin' ? 'selected' : '' }}>
                  Todos contra todos (Round Robin / Liga)
                </option>
                <option value="eliminacion_simple" {{ old('tipo_fase', $primeraFase?->tipo) === 'eliminacion_simple' ? 'selected' : '' }}>
                  Eliminación Simple (Partido Único)
                </option>
                <option value="eliminacion_ida_vuelta" {{ old('tipo_fase', $primeraFase?->tipo) === 'eliminacion_ida_vuelta' ? 'selected' : '' }}>
                  Eliminación Directa (Ida y Vuelta)
                </option>
              </select>
              @error('tipo_fase')
                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Nombre de la Fase
              </label>
              <input
                type="text"
                name="nombre_fase"
                value="{{ old('nombre_fase', $primeraFase?->nombre) }}"
                placeholder="Ej: Todos contra todos, Fase Regular..."
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
            </div>
          </div>
        </div>

      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a
          href="{{ route('admin.torneos.index') }}"
          class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
          Cancelar
        </a>
        <button
          type="submit"
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
          <ion-icon name="save-outline" class="text-lg"></ion-icon>
          Actualizar Torneo
        </button>
      </div>

    </form>
  </div>

</div>
@endsection
