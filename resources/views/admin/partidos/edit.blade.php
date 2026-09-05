@extends('admin.layouts.app')

@section('title', 'Editar Partido y Resultado')
@section('page_title', 'Modificar Partido y Cargar Resultado')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.partidos.index') }}" class="hover:text-[#59acda] transition-colors">Partidos</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Editar</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">
        {{ $partido->local->club->nombre ?? 'Local' }} vs {{ $partido->visitante->club->nombre ?? 'Visitante' }}
      </h2>
      <p class="text-xs text-slate-500">
        {{ $partido->torneo->nombre ?? 'Torneo' }} • Jornada {{ $partido->jornada ?? '-' }}
      </p>
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
    <form action="{{ route('admin.partidos.update', $partido) }}" method="POST" class="space-y-8">
      @csrf
      @method('PUT')

      {{-- Section 1: Marcador Rápido (Enfocado para cargar resultados) --}}
      <div class="rounded-2xl border border-slate-200 bg-linear-to-br from-slate-50 to-white p-6 shadow-xs space-y-4">
        <div class="flex items-center justify-between border-b border-slate-200/80 pb-3">
          <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
            <ion-icon name="football" class="text-base text-[#59acda]"></ion-icon>
            Marcador del Partido
          </h3>
          <span class="text-[11px] text-slate-500">Actualiza goles y cambia a "Finalizado" para computar en la tabla</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
          
          {{-- Local Score --}}
          <div class="flex items-center justify-between gap-4 bg-white p-4 rounded-xl border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="h-10 w-10 shrink-0 rounded-lg bg-slate-100 p-1 border border-slate-200 flex items-center justify-center overflow-hidden">
                @if ($partido->local && $partido->local->club && $partido->local->club->escudo)
                  <img src="{{ asset('storage/' . $partido->local->club->escudo) }}" alt="{{ $partido->local->club->nombre }}" class="h-full w-full object-contain">
                @else
                  <ion-icon name="shield-outline" class="text-slate-400 text-lg"></ion-icon>
                @endif
              </div>
              <div>
                <p class="text-xs uppercase font-bold text-slate-400">Local</p>
                <p class="text-sm font-bold text-slate-900">{{ $partido->local->club->nombre ?? 'Local' }}</p>
              </div>
            </div>

            <div class="w-20">
              <label class="block text-[10px] uppercase font-bold text-center text-slate-500 mb-1">Goles</label>
              <input
                type="number"
                name="goles_local"
                min="0"
                value="{{ old('goles_local', $partido->goles_local) }}"
                placeholder="0"
                class="w-full rounded-xl border border-slate-300 bg-slate-50 px-2 py-2 text-lg font-black text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20">
            </div>
          </div>

          {{-- Visitante Score --}}
          <div class="flex items-center justify-between gap-4 bg-white p-4 rounded-xl border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="h-10 w-10 shrink-0 rounded-lg bg-slate-100 p-1 border border-slate-200 flex items-center justify-center overflow-hidden">
                @if ($partido->visitante && $partido->visitante->club && $partido->visitante->club->escudo)
                  <img src="{{ asset('storage/' . $partido->visitante->club->escudo) }}" alt="{{ $partido->visitante->club->nombre }}" class="h-full w-full object-contain">
                @else
                  <ion-icon name="shield-outline" class="text-slate-400 text-lg"></ion-icon>
                @endif
              </div>
              <div>
                <p class="text-xs uppercase font-bold text-slate-400">Visitante</p>
                <p class="text-sm font-bold text-slate-900">{{ $partido->visitante->club->nombre ?? 'Visitante' }}</p>
              </div>
            </div>

            <div class="w-20">
              <label class="block text-[10px] uppercase font-bold text-center text-slate-500 mb-1">Goles</label>
              <input
                type="number"
                name="goles_visitante"
                min="0"
                value="{{ old('goles_visitante', $partido->goles_visitante) }}"
                placeholder="0"
                class="w-full rounded-xl border border-slate-300 bg-slate-50 px-2 py-2 text-lg font-black text-center text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20">
            </div>
          </div>

        </div>

        {{-- Penales (si aplica) --}}
        <div class="grid grid-cols-2 gap-4 pt-2 border-t border-slate-200/60">
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Goles Penales Local (Opcional)</label>
            <input
              type="number"
              name="goles_local_penales"
              min="0"
              value="{{ old('goles_local_penales', $partido->goles_local_penales) }}"
              placeholder="Opcional"
              class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-center text-slate-800 focus:border-[#59acda] focus:outline-none">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Goles Penales Visitante (Opcional)</label>
            <input
              type="number"
              name="goles_visitante_penales"
              min="0"
              value="{{ old('goles_visitante_penales', $partido->goles_visitante_penales) }}"
              placeholder="Opcional"
              class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-center text-slate-800 focus:border-[#59acda] focus:outline-none">
          </div>
        </div>

      </div>

      {{-- Section 2: Estado y Programación --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          Estado y Programación
        </h3>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
          
          {{-- Estado --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Estado del Partido <span class="text-rose-500">*</span>
            </label>
            <select
              name="estado"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="programado" {{ old('estado', $partido->estado) === 'programado' ? 'selected' : '' }}>Programado</option>
              <option value="en_vivo" {{ old('estado', $partido->estado) === 'en_vivo' ? 'selected' : '' }}>En Vivo</option>
              <option value="finalizado" {{ old('estado', $partido->estado) === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
              <option value="suspendido" {{ old('estado', $partido->estado) === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
              <option value="postergado" {{ old('estado', $partido->estado) === 'postergado' ? 'selected' : '' }}>Postergado</option>
            </select>
          </div>

          {{-- Fecha y Hora --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Fecha y Hora
            </label>
            <input
              type="datetime-local"
              name="fecha_hora"
              value="{{ old('fecha_hora', $partido->fecha_hora ? $partido->fecha_hora->format('Y-m-d\TH:i') : '') }}"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          {{-- Estadio --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Estadio Sede
            </label>
            <select
              name="estadio_id"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              <option value="">Cancha Local por Defecto</option>
              @foreach ($estadios as $estadio)
                <option value="{{ $estadio->id }}" {{ old('estadio_id', $partido->estadio_id) == $estadio->id ? 'selected' : '' }}>
                  {{ $estadio->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Jornada --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Jornada / Fecha
            </label>
            <input
              type="number"
              name="jornada"
              min="1"
              value="{{ old('jornada', $partido->jornada) }}"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

          {{-- Llave --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
              Llave / Etapa
            </label>
            <input
              type="text"
              name="llave"
              value="{{ old('llave', $partido->llave) }}"
              placeholder="Ej: Semifinal - Ida"
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          </div>

        </div>
      </div>

      {{-- Section 3: Datos de Competencia (Lectura / Ajuste) --}}
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#59acda] border-b border-slate-100 pb-2">
          Datos de Competencia y Equipos
        </h3>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          
          {{-- Torneo --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Torneo</label>
            <select
              name="torneo_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($torneos as $t)
                <option value="{{ $t->id }}" {{ old('torneo_id', $partido->torneo_id) == $t->id ? 'selected' : '' }}>
                  {{ $t->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Fase --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Fase</label>
            <select
              name="fase_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($fases as $fase)
                <option value="{{ $fase->id }}" {{ old('fase_id', $partido->fase_id) == $fase->id ? 'selected' : '' }}>
                  {{ $fase->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Zona --}}
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Zona</label>
            <select
              name="zona_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($zonas as $zona)
                <option value="{{ $zona->id }}" {{ old('zona_id', $partido->zona_id) == $zona->id ? 'selected' : '' }}>
                  {{ $zona->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Placeholder or empty --}}
          <div></div>

          {{-- Equipo Local --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Equipo Local</label>
            <select
              name="equipo_local_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($equipos as $eq)
                <option value="{{ $eq->id }}" {{ old('equipo_local_id', $partido->equipo_local_id) == $eq->id ? 'selected' : '' }}>
                  {{ $eq->club->nombre ?? $eq->nombre }} ({{ $eq->categoria->nombre ?? '' }})
                </option>
              @endforeach
            </select>
          </div>

          {{-- Equipo Visitante --}}
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Equipo Visitante</label>
            <select
              name="equipo_visitante_id"
              required
              class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
              @foreach ($equipos as $eq)
                <option value="{{ $eq->id }}" {{ old('equipo_visitante_id', $partido->equipo_visitante_id) == $eq->id ? 'selected' : '' }}>
                  {{ $eq->club->nombre ?? $eq->nombre }} ({{ $eq->categoria->nombre ?? '' }})
                </option>
              @endforeach
            </select>
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
          Actualizar Partido y Marcador
        </button>
      </div>

    </form>
  </div>

</div>
@endsection
