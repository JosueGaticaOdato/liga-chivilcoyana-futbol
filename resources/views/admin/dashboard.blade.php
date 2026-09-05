@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Tablero Principal')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Dashboard</span>
@endsection

@section('content')
<div class="space-y-8">

  {{-- Welcome Banner --}}
  <div class="relative overflow-hidden rounded-2xl bg-linear-to-r from-[#121e36] via-[#1a2c4e] to-[#25457a] p-6 sm:p-8 text-white shadow-lg">
    <div class="relative z-10 max-w-2xl space-y-2">
      <div class="inline-flex items-center gap-2 rounded-full bg-[#59acda]/20 px-3 py-1 text-xs font-semibold text-[#8ed3f8] border border-[#59acda]/30">
        <ion-icon name="sparkles"></ion-icon>
        Temporada Oficial 2026
      </div>
      <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
        Panel de Control de la Liga
      </h2>
      <p class="text-sm sm:text-base text-slate-300">
        Gestiona torneos, calendario de partidos, carga de marcadores y clubes participantes de forma centralizada.
      </p>
      
      <div class="pt-3 flex flex-wrap gap-3">
        <a
          href="{{ route('admin.partidos.create') }}"
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
          <ion-icon name="add-circle-outline" class="text-base"></ion-icon>
          Programar Partido
        </a>
        <a
          href="{{ route('admin.torneos.create') }}"
          class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-xs px-4 py-2.5 text-xs font-bold text-white border border-white/15 hover:bg-white/20 transition-colors">
          <ion-icon name="trophy-outline" class="text-base"></ion-icon>
          Nuevo Torneo
        </a>
        <a
          href="{{ route('admin.clubes.create') }}"
          class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-xs px-4 py-2.5 text-xs font-bold text-white border border-white/15 hover:bg-white/20 transition-colors">
          <ion-icon name="shield-outline" class="text-base"></ion-icon>
          Registrar Club
        </a>
      </div>
    </div>

    {{-- Abstract background pattern --}}
    <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-[#59acda]/10 blur-3xl pointer-events-none"></div>
  </div>

  {{-- Metrics Cards Grid --}}
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    
    {{-- Torneos Activos --}}
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:border-[#59acda]/60 hover:shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Torneos Activos</span>
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#59acda]/10 text-[#59acda] group-hover:bg-[#59acda] group-hover:text-white transition-colors">
          <ion-icon name="trophy-outline" class="text-xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 flex items-baseline gap-2">
        <span class="text-3xl font-black tracking-tight text-slate-900">{{ $stats['torneos_activos'] }}</span>
        <span class="text-xs text-slate-500 font-medium">de {{ $stats['torneos_total'] }} totales</span>
      </div>
      <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
        <a href="{{ route('admin.torneos.index', ['estado' => 'en_curso']) }}" class="font-semibold text-[#59acda] hover:underline flex items-center gap-1">
          Ver competencias <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Partidos Programados --}}
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:border-amber-400/60 hover:shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Partidos Próximos</span>
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
          <ion-icon name="calendar-outline" class="text-xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 flex items-baseline gap-2">
        <span class="text-3xl font-black tracking-tight text-slate-900">{{ $stats['partidos_programados'] }}</span>
        <span class="text-xs text-amber-600 font-semibold bg-amber-50 px-2 py-0.5 rounded-md">Por disputar</span>
      </div>
      <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
        <a href="{{ route('admin.partidos.index', ['estado' => 'programado']) }}" class="font-semibold text-amber-600 hover:underline flex items-center gap-1">
          Ver fixture <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Partidos Finalizados --}}
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:border-emerald-400/60 hover:shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Partidos Jugados</span>
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
          <ion-icon name="checkmark-done-circle-outline" class="text-xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 flex items-baseline gap-2">
        <span class="text-3xl font-black tracking-tight text-slate-900">{{ $stats['partidos_finalizados'] }}</span>
        <span class="text-xs text-slate-500 font-medium">con resultado</span>
      </div>
      <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
        <a href="{{ route('admin.partidos.index', ['estado' => 'finalizado']) }}" class="font-semibold text-emerald-600 hover:underline flex items-center gap-1">
          Ver resultados <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Clubes Federados --}}
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:border-indigo-400/60 hover:shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Clubes Afiliados</span>
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-600 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
          <ion-icon name="shield-outline" class="text-xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 flex items-baseline gap-2">
        <span class="text-3xl font-black tracking-tight text-slate-900">{{ $stats['clubes_activos'] }}</span>
        <span class="text-xs text-slate-500 font-medium">({{ $stats['equipos_total'] }} equipos)</span>
      </div>
      <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
        <a href="{{ route('admin.clubes.index') }}" class="font-semibold text-indigo-600 hover:underline flex items-center gap-1">
          Ver instituciones <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

  </div>

  {{-- Main Grid: Próximos Partidos & Resultados Recientes --}}
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

    {{-- Proximos Partidos --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-xs">
      <div class="flex items-center justify-between border-b border-slate-100 pb-4">
        <div>
          <h3 class="font-bold text-slate-900 text-base">Próximos Partidos a Disputar</h3>
          <p class="text-xs text-slate-500">Encuentros programados en la agenda</p>
        </div>
        <a
          href="{{ route('admin.partidos.index', ['estado' => 'programado']) }}"
          class="inline-flex items-center gap-1 text-xs font-semibold text-[#59acda] hover:underline">
          Ver todos <ion-icon name="chevron-forward-outline"></ion-icon>
        </a>
      </div>

      <div class="mt-4 divide-y divide-slate-100">
        @forelse ($proximosPartidos as $partido)
          <div class="py-3.5 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <span class="font-semibold text-slate-700">{{ $partido->torneo->nombre ?? 'Torneo' }}</span>
                <span>•</span>
                <span>{{ $partido->fecha_hora ? $partido->fecha_hora->format('d/m H:i') . ' hs' : 'A confirmar' }}</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 flex-1 justify-end text-right">
                  <span class="font-semibold text-slate-900 text-sm truncate">{{ $partido->local->nombre ?? $partido->local->club->nombre ?? 'Local' }}</span>
                  <div class="h-6 w-6 rounded-md bg-slate-100 p-0.5 shrink-0 flex items-center justify-center overflow-hidden border border-slate-200">
                    @if ($partido->local && $partido->local->club && $partido->local->club->escudo)
                      <img src="{{ asset('storage/' . $partido->local->club->escudo) }}" class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield" class="text-xs text-slate-400"></ion-icon>
                    @endif
                  </div>
                </div>

                <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded">VS</span>

                <div class="flex items-center gap-2 flex-1">
                  <div class="h-6 w-6 rounded-md bg-slate-100 p-0.5 shrink-0 flex items-center justify-center overflow-hidden border border-slate-200">
                    @if ($partido->visitante && $partido->visitante->club && $partido->visitante->club->escudo)
                      <img src="{{ asset('storage/' . $partido->visitante->club->escudo) }}" class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield" class="text-xs text-slate-400"></ion-icon>
                    @endif
                  </div>
                  <span class="font-semibold text-slate-900 text-sm truncate">{{ $partido->visitante->nombre ?? $partido->visitante->club->nombre ?? 'Visitante' }}</span>
                </div>
              </div>
            </div>

            <a
              href="{{ route('admin.partidos.edit', $partido) }}"
              class="shrink-0 rounded-xl bg-slate-100 p-2 text-slate-600 hover:bg-[#59acda] hover:text-white transition-colors"
              title="Cargar resultado / Editar">
              <ion-icon name="create-outline" class="text-base"></ion-icon>
            </a>
          </div>
        @empty
          <div class="py-12 text-center">
            <ion-icon name="calendar-outline" class="text-4xl text-slate-300"></ion-icon>
            <p class="mt-2 text-sm text-slate-500 font-medium">No hay partidos programados próximamente</p>
            <a href="{{ route('admin.partidos.create') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-[#59acda] hover:underline">
              <ion-icon name="add-outline"></ion-icon> Programar un partido
            </a>
          </div>
        @endforelse
      </div>
    </div>

    {{-- Resultados Recientes --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-xs">
      <div class="flex items-center justify-between border-b border-slate-100 pb-4">
        <div>
          <h3 class="font-bold text-slate-900 text-base">Últimos Resultados Registrados</h3>
          <p class="text-xs text-slate-500">Marcadores finales cargados</p>
        </div>
        <a
          href="{{ route('admin.partidos.index', ['estado' => 'finalizado']) }}"
          class="inline-flex items-center gap-1 text-xs font-semibold text-[#59acda] hover:underline">
          Ver historial <ion-icon name="chevron-forward-outline"></ion-icon>
        </a>
      </div>

      <div class="mt-4 divide-y divide-slate-100">
        @forelse ($ultimosResultados as $partido)
          <div class="py-3.5 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <span class="font-semibold text-slate-700">{{ $partido->torneo->nombre ?? 'Torneo' }}</span>
                <span>•</span>
                <span>{{ $partido->fecha_hora ? $partido->fecha_hora->format('d/m/Y') : 'Finalizado' }}</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 flex-1 justify-end text-right">
                  <span class="font-semibold text-slate-900 text-sm truncate {{ ($partido->goles_local > $partido->goles_visitante) ? 'font-bold' : '' }}">
                    {{ $partido->local->nombre ?? $partido->local->club->nombre ?? 'Local' }}
                  </span>
                  <div class="h-6 w-6 rounded-md bg-slate-100 p-0.5 shrink-0 flex items-center justify-center overflow-hidden border border-slate-200">
                    @if ($partido->local && $partido->local->club && $partido->local->club->escudo)
                      <img src="{{ asset('storage/' . $partido->local->club->escudo) }}" class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield" class="text-xs text-slate-400"></ion-icon>
                    @endif
                  </div>
                </div>

                <div class="rounded-lg bg-slate-900 px-2.5 py-1 text-xs font-extrabold text-white tracking-widest">
                  {{ $partido->goles_local ?? 0 }} - {{ $partido->goles_visitante ?? 0 }}
                </div>

                <div class="flex items-center gap-2 flex-1">
                  <div class="h-6 w-6 rounded-md bg-slate-100 p-0.5 shrink-0 flex items-center justify-center overflow-hidden border border-slate-200">
                    @if ($partido->visitante && $partido->visitante->club && $partido->visitante->club->escudo)
                      <img src="{{ asset('storage/' . $partido->visitante->club->escudo) }}" class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield" class="text-xs text-slate-400"></ion-icon>
                    @endif
                  </div>
                  <span class="font-semibold text-slate-900 text-sm truncate {{ ($partido->goles_visitante > $partido->goles_local) ? 'font-bold' : '' }}">
                    {{ $partido->visitante->nombre ?? $partido->visitante->club->nombre ?? 'Visitante' }}
                  </span>
                </div>
              </div>
            </div>

            <a
              href="{{ route('admin.partidos.edit', $partido) }}"
              class="shrink-0 rounded-xl bg-slate-100 p-2 text-slate-600 hover:bg-[#59acda] hover:text-white transition-colors"
              title="Ver detalles / Corregir">
              <ion-icon name="eye-outline" class="text-base"></ion-icon>
            </a>
          </div>
        @empty
          <div class="py-12 text-center">
            <ion-icon name="football-outline" class="text-4xl text-slate-300"></ion-icon>
            <p class="mt-2 text-sm text-slate-500 font-medium">Aún no se han registrado resultados</p>
          </div>
        @endforelse
      </div>
    </div>

  </div>

  {{-- Torneos Activos Section --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
      <div>
        <h3 class="text-base font-bold text-slate-900">Torneos en Curso</h3>
        <p class="text-xs text-slate-500">Competencias oficiales activas</p>
      </div>
      <a href="{{ route('admin.torneos.index') }}" class="text-xs font-semibold text-[#59acda] hover:underline">
        Ver todos los torneos
      </a>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      @forelse ($torneosActivos as $torneo)
        <div class="rounded-xl border border-slate-200/90 bg-linear-to-br from-white to-slate-50/60 p-4 transition-all hover:border-[#59acda]/60 hover:shadow-sm">
          <div class="flex items-start justify-between">
            <div>
              <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-0.5 text-[11px] font-semibold text-emerald-800">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                En Curso
              </span>
              <h4 class="mt-2 font-bold text-slate-900 text-base">{{ $torneo->nombre }}</h4>
              <p class="text-xs text-slate-500">{{ $torneo->categoria->nombre ?? 'Cat' }} • Temporada {{ $torneo->temporada->nombre ?? '2026' }}</p>
            </div>
            <a
              href="{{ route('admin.torneos.edit', $torneo) }}"
              class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition-colors">
              <ion-icon name="ellipsis-vertical" class="text-lg"></ion-icon>
            </a>
          </div>

          <div class="mt-4 flex items-center justify-between pt-3 border-t border-slate-100 text-xs text-slate-500">
            <span>Inicio: {{ $torneo->fecha_inicio ? $torneo->fecha_inicio->format('d/m/Y') : 'S/D' }}</span>
            <a href="{{ route('admin.partidos.index', ['torneo_id' => $torneo->id]) }}" class="font-semibold text-[#59acda] hover:underline">
              Ver partidos →
            </a>
          </div>
        </div>
      @empty
        <div class="col-span-full py-8 text-center text-slate-400 text-sm">
          <p>No hay torneos marcados en curso actualmente.</p>
        </div>
      @endforelse
    </div>
  </div>

</div>
@endsection
