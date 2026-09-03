@extends('admin.layouts.app')

@section('title', 'Partidos y Resultados')
@section('page_title', 'Gestión de Partidos')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Partidos</span>
@endsection

@section('content')
<div class="space-y-6">

  {{-- Header with action button --}}
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Programación y Marcadores</h2>
      <p class="text-xs text-slate-500">Carga fixtures, programa estadios, actualiza resultados y estados de juego.</p>
    </div>
    <a
      href="{{ route('admin.partidos.create', ['torneo_id' => request('torneo_id')]) }}"
      class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-all transform hover:-translate-y-0.5">
      <ion-icon name="add-circle-outline" class="text-lg"></ion-icon>
      Cargar Partido
    </a>
  </div>

  {{-- Filter bar --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-xs">
    <form method="GET" action="{{ route('admin.partidos.index') }}" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">
      
      {{-- Torneo --}}
      <div class="lg:col-span-2">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Torneo</label>
        <select
          name="torneo_id"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todos los torneos</option>
          @foreach ($torneos as $torneo)
            <option value="{{ $torneo->id }}" {{ request('torneo_id') == $torneo->id ? 'selected' : '' }}>
              {{ $torneo->nombre }} ({{ $torneo->categoria->nombre ?? '' }} - {{ $torneo->temporada->nombre ?? '' }})
            </option>
          @endforeach
        </select>
      </div>

      {{-- Estado --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Estado</label>
        <select
          name="estado"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todos los estados</option>
          <option value="programado" {{ request('estado') === 'programado' ? 'selected' : '' }}>Programado</option>
          <option value="en_vivo" {{ request('estado') === 'en_vivo' ? 'selected' : '' }}>En Vivo</option>
          <option value="finalizado" {{ request('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
          <option value="suspendido" {{ request('estado') === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
          <option value="postergado" {{ request('estado') === 'postergado' ? 'selected' : '' }}>Postergado</option>
        </select>
      </div>

      {{-- Jornada --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Jornada / Fecha</label>
        <input
          type="number"
          name="jornada"
          min="1"
          value="{{ request('jornada') }}"
          placeholder="Nº Jornada"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
      </div>

      {{-- Submit --}}
      <div class="flex items-end gap-2">
        <button
          type="submit"
          class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition-colors w-full sm:w-auto">
          Filtrar
        </button>
        @if (request()->hasAny(['torneo_id', 'estado', 'jornada', 'fecha']))
          <a
            href="{{ route('admin.partidos.index') }}"
            class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
            Limpiar
          </a>
        @endif
      </div>

    </form>
  </div>

  {{-- Partidos Table --}}
  <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-xs">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50/80 text-slate-600 uppercase tracking-wider font-semibold border-b border-slate-200">
          <tr>
            <th class="px-5 py-3.5">Torneo / Jornada</th>
            <th class="px-5 py-3.5 text-center">Enfrentamiento y Marcador</th>
            <th class="px-5 py-3.5">Día, Hora y Estadio</th>
            <th class="px-5 py-3.5">Estado</th>
            <th class="px-5 py-3.5 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($partidos as $partido)
            <tr class="hover:bg-slate-50/80 transition-colors">
              
              {{-- Torneo & Fase --}}
              <td class="px-5 py-4">
                <div class="font-bold text-slate-900 text-sm">
                  {{ $partido->torneo->nombre ?? 'Torneo' }}
                </div>
                <div class="text-[11px] text-slate-500 font-medium">
                  {{ $partido->torneo->categoria->nombre ?? '' }} • Fecha {{ $partido->jornada ?? '-' }}
                </div>
                @if ($partido->fase)
                  <div class="text-[10px] text-slate-400">
                    {{ $partido->fase->nombre }} ({{ $partido->zona->nombre ?? 'Zona General' }})
                  </div>
                @endif
              </td>

              {{-- Teams & Score --}}
              <td class="px-5 py-4">
                <div class="flex items-center justify-center gap-4">
                  
                  {{-- Local --}}
                  <div class="flex items-center gap-2 w-36 justify-end text-right">
                    <span class="font-bold text-slate-900 text-sm truncate">
                      {{ $partido->local->nombre ?? $partido->local->club->nombre ?? 'Local' }}
                    </span>
                    <div class="h-8 w-8 shrink-0 rounded-lg bg-slate-100 p-0.5 border border-slate-200 flex items-center justify-center overflow-hidden">
                      @if ($partido->local && $partido->local->club && $partido->local->club->escudo)
                        <img
                          src="{{ asset('storage/' . $partido->local->club->escudo) }}"
                          alt="{{ $partido->local->club->nombre }}"
                          class="h-full w-full object-contain">
                      @else
                        <ion-icon name="shield-outline" class="text-slate-400 text-sm"></ion-icon>
                      @endif
                    </div>
                  </div>

                  {{-- Score or VS --}}
                  <div class="shrink-0">
                    @if ($partido->estado === 'finalizado' || $partido->estado === 'en_vivo')
                      <div class="flex items-center gap-1.5 rounded-lg bg-[#121e36] px-3 py-1 text-white font-extrabold text-sm tracking-wider shadow-xs">
                        <span>{{ $partido->goles_local ?? 0 }}</span>
                        <span class="text-slate-400 text-xs">-</span>
                        <span>{{ $partido->goles_visitante ?? 0 }}</span>
                      </div>
                      @if ($partido->goles_local_penales !== null || $partido->goles_visitante_penales !== null)
                        <div class="text-center text-[10px] text-slate-400 mt-0.5 font-medium">
                          ({{ $partido->goles_local_penales }}-{{ $partido->goles_visitante_penales }} pen)
                        </div>
                      @endif
                    @else
                      <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-500 uppercase">
                        vs
                      </span>
                    @endif
                  </div>

                  {{-- Visitante --}}
                  <div class="flex items-center gap-2 w-36 justify-start text-left">
                    <div class="h-8 w-8 shrink-0 rounded-lg bg-slate-100 p-0.5 border border-slate-200 flex items-center justify-center overflow-hidden">
                      @if ($partido->visitante && $partido->visitante->club && $partido->visitante->club->escudo)
                        <img
                          src="{{ asset('storage/' . $partido->visitante->club->escudo) }}"
                          alt="{{ $partido->visitante->club->nombre }}"
                          class="h-full w-full object-contain">
                      @else
                        <ion-icon name="shield-outline" class="text-slate-400 text-sm"></ion-icon>
                      @endif
                    </div>
                    <span class="font-bold text-slate-900 text-sm truncate">
                      {{ $partido->visitante->nombre ?? $partido->visitante->club->nombre ?? 'Visitante' }}
                    </span>
                  </div>

                </div>
              </td>

              {{-- Date & Stadium --}}
              <td class="px-5 py-4 text-slate-600">
                <div class="font-semibold text-slate-800">
                  {{ $partido->fecha_hora ? $partido->fecha_hora->format('d/m/Y - H:i \h\s') : 'A definir' }}
                </div>
                <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5">
                  <ion-icon name="location-outline"></ion-icon>
                  <span class="truncate">{{ $partido->estadio->nombre ?? 'Sin estadio' }}</span>
                </div>
              </td>

              {{-- Estado Badge --}}
              <td class="px-5 py-4">
                @if ($partido->estado === 'finalizado')
                  <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-700">
                    <ion-icon name="checkmark-done" class="text-slate-500"></ion-icon>
                    Finalizado
                  </span>
                @elseif ($partido->estado === 'en_vivo')
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-100 px-2.5 py-1 text-[11px] font-semibold text-rose-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-rose-600 animate-ping"></span>
                    En Vivo
                  </span>
                @elseif ($partido->estado === 'programado')
                  <span class="inline-flex items-center gap-1 rounded-full bg-sky-100 px-2.5 py-1 text-[11px] font-semibold text-[#20688f]">
                    <ion-icon name="calendar-outline" class="text-xs"></ion-icon>
                    Programado
                  </span>
                @elseif ($partido->estado === 'suspendido')
                  <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-800">
                    <ion-icon name="pause-circle-outline" class="text-xs"></ion-icon>
                    Suspendido
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500">
                    {{ ucfirst($partido->estado) }}
                  </span>
                @endif
              </td>

              {{-- Actions --}}
              <td class="px-5 py-4 text-right">
                <div class="inline-flex items-center gap-1">
                  
                  {{-- Public detail --}}
                  <a
                    href="{{ route('partidos.show', $partido) }}"
                    target="_blank"
                    title="Ver en web pública"
                    class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition-colors">
                    <ion-icon name="eye-outline" class="text-base"></ion-icon>
                  </a>

                  {{-- Edit & Load score --}}
                  <a
                    href="{{ route('admin.partidos.edit', $partido) }}"
                    title="Cargar marcador / Editar"
                    class="rounded-lg p-2 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
                    <ion-icon name="create-outline" class="text-base"></ion-icon>
                  </a>

                  {{-- Delete --}}
                  <form
                    action="{{ route('admin.partidos.destroy', $partido) }}"
                    method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar este partido?');"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      title="Eliminar partido"
                      class="rounded-lg p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                      <ion-icon name="trash-outline" class="text-base"></ion-icon>
                    </button>
                  </form>

                </div>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="5" class="py-10 text-center text-slate-400">
                <ion-icon name="football-outline" class="text-4xl mb-2 text-slate-300"></ion-icon>
                <p class="font-medium">No se encontraron partidos registrados con estos filtros.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($partidos->hasPages())
      <div class="border-t border-slate-200 px-5 py-4 bg-slate-50/50">
        {{ $partidos->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
