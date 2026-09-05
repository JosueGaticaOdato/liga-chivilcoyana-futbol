@extends('admin.layouts.app')

@section('title', 'Cargar Partido')
@section('page_title', 'Programar Nuevo Partido')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.partidos.index') }}" class="hover:text-[#59acda] transition-colors">Partidos</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Crear</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Programación de Encuentro</h2>
      <p class="text-xs text-slate-500">Define los equipos contendientes, estadio, fecha y horario del cotejo.</p>
    </div>
    <a
      href="{{ route('admin.partidos.index') }}"
      class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
      <ion-icon name="arrow-back-outline"></ion-icon>
      Volver al listado
    </a>
  </div>

  {{-- Form Card --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-xs">
    <form action="{{ route('admin.partidos.store') }}" method="POST" class="space-y-8">
      @csrf

      {{-- Section 1: Torneo y Fase --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          1. Competencia y Fase
        </h3>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
          
          {{-- Torneo --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Torneo <span class="text-rose-500">*</span>
            </label>
            <select
              name="torneo_id"
              id="torneo_id"
              required
              onchange="window.location.href='{{ route('admin.partidos.create') }}?torneo_id=' + this.value"
              class="w-full rounded-xl border {{ $errors->has('torneo_id') ? 'border-rose-400' : 'border-slate-200' }} bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($torneos as $t)
                <option value="{{ $t->id }}" {{ (old('torneo_id', $selectedTorneoId) == $t->id) ? 'selected' : '' }}>
                  {{ $t->nombre }} ({{ $t->categoria->nombre ?? '' }})
                </option>
              @endforeach
            </select>
          </div>

          {{-- Fase --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Fase <span class="text-rose-500">*</span>
            </label>
            <select
              name="fase_id"
              id="fase_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($fases as $fase)
                <option value="{{ $fase->id }}" {{ old('fase_id') == $fase->id ? 'selected' : '' }}>
                  {{ $fase->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Zona --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Zona / Grupo <span class="text-rose-500">*</span>
            </label>
            <select
              name="zona_id"
              id="zona_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($zonas as $zona)
                <option value="{{ $zona->id }}" {{ old('zona_id') == $zona->id ? 'selected' : '' }}>
                  {{ $zona->nombre }}
                </option>
              @endforeach
            </select>
          </div>

        </div>
      </div>

      {{-- Section 2: Equipos Enfrentados --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          2. Equipos Contendientes
        </h3>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          
          {{-- Equipo Local --}}
          <div class="rounded-2xl border border-slate-200/90 bg-slate-50/40 p-4">
            <label class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">
              Equipo Local <span class="text-rose-500">*</span>
            </label>
            <select
              name="equipo_local_id"
              id="equipo_local_id"
              required
              class="w-full rounded-xl border {{ $errors->has('equipo_local_id') ? 'border-rose-400' : 'border-slate-200' }} bg-white px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="">Seleccionar local</option>
              @forelse ($equipos as $eq)
                <option value="{{ $eq->id }}" {{ old('equipo_local_id') == $eq->id ? 'selected' : '' }}>
                  {{ $eq->nombre ?? $eq->club->nombre }}
                </option>
              @empty
                <option value="" disabled>No hay equipos participantes en este torneo</option>
              @endforelse
            </select>
            @error('equipo_local_id')
              <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Equipo Visitante --}}
          <div class="rounded-2xl border border-slate-200/90 bg-slate-50/40 p-4">
            <label class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">
              Equipo Visitante <span class="text-rose-500">*</span>
            </label>
            <select
              name="equipo_visitante_id"
              id="equipo_visitante_id"
              required
              class="w-full rounded-xl border {{ $errors->has('equipo_visitante_id') ? 'border-rose-400' : 'border-slate-200' }} bg-white px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="">Seleccionar visitante</option>
              @forelse ($equipos as $eq)
                <option value="{{ $eq->id }}" {{ old('equipo_visitante_id') == $eq->id ? 'selected' : '' }}>
                  {{ $eq->nombre ?? $eq->club->nombre }}
                </option>
              @empty
                <option value="" disabled>No hay equipos participantes en este torneo</option>
              @endforelse
            </select>
            @error('equipo_visitante_id')
              <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
            @enderror
          </div>

        </div>
      </div>

      {{-- Section 3: Programación y Estadio --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          3. Calendario, Sede y Estado
        </h3>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          
          {{-- Fecha y Hora --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Fecha y Hora de Juego
            </label>
            <input
              type="datetime-local"
              name="fecha_hora"
              value="{{ old('fecha_hora') }}"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          {{-- Estadio --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Estadio Sede <span class="text-xs font-normal text-slate-400">(Opcional)</span>
            </label>
            <select
              name="estadio_id"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="">Automático (Cancha del Club Local)</option>
              @foreach ($estadios as $estadio)
                <option value="{{ $estadio->id }}" {{ old('estadio_id') == $estadio->id ? 'selected' : '' }}>
                  {{ $estadio->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Jornada --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Nº de Fecha / Jornada
            </label>
            <input
              type="number"
              name="jornada"
              min="1"
              value="{{ old('jornada', 1) }}"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          {{-- Llave --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Llave / Etapa
            </label>
            <input
              type="text"
              name="llave"
              value="{{ old('llave') }}"
              placeholder="Ej: Cuartos - Llave 1"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          {{-- Estado --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Estado del Partido <span class="text-rose-500">*</span>
            </label>
            <select
              name="estado"
              id="estado_select"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="programado" {{ old('estado', 'programado') === 'programado' ? 'selected' : '' }}>Programado</option>
              <option value="en_vivo" {{ old('estado') === 'en_vivo' ? 'selected' : '' }}>En Vivo (En disputa)</option>
              <option value="finalizado" {{ old('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado (Con resultado)</option>
              <option value="suspendido" {{ old('estado') === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
              <option value="postergado" {{ old('estado') === 'postergado' ? 'selected' : '' }}>Postergado</option>
            </select>
          </div>

        </div>
      </div>

      {{-- Section 4: Marcador (Opcional si ya se jugó) --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          4. Marcador y Resultado <span class="text-xs font-normal text-slate-400">(Completar si ya finalizó)</span>
        </h3>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
          
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Goles Local
            </label>
            <input
              type="number"
              name="goles_local"
              min="0"
              value="{{ old('goles_local') }}"
              placeholder="0"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm font-bold text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Goles Visitante
            </label>
            <input
              type="number"
              name="goles_visitante"
              min="0"
              value="{{ old('goles_visitante') }}"
              placeholder="0"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm font-bold text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Penales Local
            </label>
            <input
              type="number"
              name="goles_local_penales"
              min="0"
              value="{{ old('goles_local_penales') }}"
              placeholder="Opcional"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Penales Visitante
            </label>
            <input
              type="number"
              name="goles_visitante_penales"
              min="0"
              value="{{ old('goles_visitante_penales') }}"
              placeholder="Opcional"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

        </div>
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a
          href="{{ route('admin.partidos.index') }}"
          class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
          Cancelar
        </a>
        <button
          type="submit"
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
          <ion-icon name="save-outline" class="text-lg"></ion-icon>
          Guardar Partido
        </button>
      </div>

    </form>
  </div>

</div>
@endsection
