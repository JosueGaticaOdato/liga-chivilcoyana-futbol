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
<div class="max-w-4xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Editar Torneo: {{ $torneo->nombre }}</h2>
      <p class="text-xs text-slate-500">Actualiza las fechas, categoría, estado y clubes participantes.</p>
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
    <form action="{{ route('admin.torneos.update', $torneo) }}" method="POST" id="torneoEditForm" class="space-y-8">
      @csrf
      @method('PUT')

      {{-- SECCIÓN 1: DATOS GENERALES --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2 flex items-center gap-1.5">
          <ion-icon name="trophy-outline" class="text-base"></ion-icon>
          1. Datos Principales del Torneo
        </h3>

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
              id="categoria_select"
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
              rows="2"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">{{ old('descripcion', $torneo->descripcion) }}</textarea>
          </div>

        </div>
      </div>

      {{-- SECCIÓN 2: FORMATO DE LA PRIMERA FASE --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2 flex items-center gap-1.5">
          <ion-icon name="git-branch-outline" class="text-base"></ion-icon>
          2. Formato de la Primera Fase
        </h3>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Tipo de Competición
            </label>
            <select
              name="tipo_fase"
              id="tipo_fase_select"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
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
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>
        </div>
      </div>

      {{-- SECCIÓN 3: ELECCIÓN DE EQUIPOS PARTICIPANTES --}}
      <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-2 gap-2">
          <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] flex items-center gap-1.5">
              <ion-icon name="people-outline" class="text-base"></ion-icon>
              3. Clubes y Equipos Participantes
            </h3>
            <p class="text-xs text-slate-500">Selecciona o desmarca los clubes que integran este torneo en esta categoría.</p>
          </div>
          <div class="flex items-center gap-2">
            <button
              type="button"
              id="btn-select-all"
              class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
              Seleccionar todos
            </button>
            <button
              type="button"
              id="btn-deselect-all"
              class="rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
              Deseleccionar
            </button>
            <span class="rounded-full bg-[#59acda]/10 px-3 py-1 text-xs font-bold text-[#2778a3]" id="selected-counter">
              0 seleccionados
            </span>
          </div>
        </div>

        {{-- Buscador rápido de clubes --}}
        <div class="relative">
          <input
            type="text"
            id="search-clubes-input"
            placeholder="Filtrar clubes por nombre..."
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Grid de Clubes --}}
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 max-h-96 overflow-y-auto p-1" id="equipos-grid">
          @foreach ($clubes as $club)
            @php
              $participa = in_array($club->id, old('club_ids', $participantesClubIds ?? []));
            @endphp

            <div
              class="club-card rounded-2xl border border-slate-200 bg-white p-3.5 shadow-xs transition-all hover:border-[#59acda]/60"
              data-club-name="{{ strtolower($club->nombre) }}"
              data-club-id="{{ $club->id }}">
              
              {{-- Cabecera del Club --}}
              <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-2.5 min-w-0">
                  <div class="h-8 w-8 shrink-0 rounded-lg bg-slate-100 p-0.5 border border-slate-200 flex items-center justify-center overflow-hidden">
                    @if ($club->escudo)
                      <img src="{{ asset('storage/' . $club->escudo) }}" alt="{{ $club->nombre }}" class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield-outline" class="text-sm text-slate-400"></ion-icon>
                    @endif
                  </div>
                  <span class="font-bold text-slate-900 text-sm truncate">{{ $club->nombre }}</span>
                </div>
              </div>

              {{-- Lista de Equipos del Club --}}
              <div class="mt-3 space-y-2 border-t border-slate-100 pt-2.5" id="equipos-container-{{ $club->id }}">
                <label class="flex items-center justify-between gap-2 rounded-xl bg-slate-50/70 p-2 cursor-pointer hover:bg-slate-100 transition-colors">
                  <span class="text-xs font-semibold text-slate-800 truncate">
                    Equipo Oficial ({{ $club->nombre }})
                  </span>
                  <input
                    type="checkbox"
                    name="club_ids[]"
                    value="{{ $club->id }}"
                    class="team-checkbox h-4 w-4 rounded border-slate-300 text-[#59acda] focus:ring-[#59acda]"
                    {{ $participa ? 'checked' : '' }}>
                </label>
              </div>

              {{-- Botón para añadir Equipo B --}}
              <div class="mt-2 text-right">
                <button
                  type="button"
                  onclick="agregarEquipoB({{ $club->id }}, '{{ addslashes($club->nombre) }}')"
                  class="text-[11px] font-semibold text-[#59acda] hover:text-[#387c9f] hover:underline inline-flex items-center gap-1">
                  <ion-icon name="add-outline"></ion-icon>
                  + Agregar Equipo B
                </button>
              </div>

            </div>
          @endforeach
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const counter = document.getElementById('selected-counter');
    const searchInput = document.getElementById('search-clubes-input');
    const cards = document.querySelectorAll('.club-card');

    function updateCounter() {
      const selected = document.querySelectorAll('.team-checkbox:checked').length;
      if (counter) counter.textContent = `${selected} seleccionados`;
    }

    document.addEventListener('change', (e) => {
      if (e.target.classList.contains('team-checkbox')) {
        updateCounter();
      }
    });

    document.getElementById('btn-select-all')?.addEventListener('click', () => {
      document.querySelectorAll('.club-card:not(.hidden) .team-checkbox').forEach(cb => cb.checked = true);
      updateCounter();
    });

    document.getElementById('btn-deselect-all')?.addEventListener('click', () => {
      document.querySelectorAll('.team-checkbox').forEach(cb => cb.checked = false);
      updateCounter();
    });

    searchInput?.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      cards.forEach(card => {
        const name = card.getAttribute('data-club-name') || '';
        if (name.includes(term)) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    });

    updateCounter();
  });

  let equipoBCounter = 2000;
  function agregarEquipoB(clubId, clubNombre) {
    const container = document.getElementById(`equipos-container-${clubId}`);
    if (!container) return;

    equipoBCounter++;
    const defaultName = `${clubNombre} B`;

    const html = `
      <div class="flex items-center justify-between gap-2 rounded-xl bg-amber-50/80 border border-amber-200/60 p-2 mt-1.5 transition-all">
        <div class="flex-1 min-w-0 pr-1">
          <input
            type="text"
            name="nuevos_equipos[${equipoBCounter}][nombre]"
            value="${defaultName}"
            class="w-full text-xs font-bold text-slate-800 bg-white rounded-lg border border-amber-200 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-[#59acda]"
            placeholder="Nombre (ej: ${clubNombre} B)">
          <input type="hidden" name="nuevos_equipos[${equipoBCounter}][club_id]" value="${clubId}">
        </div>
        <input
          type="checkbox"
          checked
          class="team-checkbox h-4 w-4 rounded border-slate-300 text-[#59acda] focus:ring-[#59acda]"
          onchange="document.getElementById('selected-counter').textContent = document.querySelectorAll('.team-checkbox:checked').length + ' seleccionados'">
      </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
    const counter = document.getElementById('selected-counter');
    if (counter) {
      counter.textContent = `${document.querySelectorAll('.team-checkbox:checked').length} seleccionados`;
    }
  }
</script>
@endpush
@endsection
