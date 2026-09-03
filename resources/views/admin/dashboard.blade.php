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
  <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#121e36] via-[#1a2c4e] to-[#25457a] p-6 sm:p-8 text-white shadow-lg">
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
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-[#459ecf] transition-all transform hover:-translate-y-0.5">
          <ion-icon name="add-circle" class="text-lg"></ion-icon>
          Cargar Nuevo Partido
        </a>
        <a
          href="{{ route('admin.torneos.create') }}"
          class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2.5 text-sm font-semibold text-white border border-white/20 hover:bg-white/20 transition-all">
          <ion-icon name="trophy" class="text-lg text-[#8ed3f8]"></ion-icon>
          Crear Torneo
        </a>
      </div>
    </div>

    {{-- Subtle decorative soccer ball background icon --}}
    <div class="absolute -right-6 -bottom-10 text-white/5 pointer-events-none">
      <ion-icon name="football" class="text-[14rem]"></ion-icon>
    </div>
  </div>

  {{-- Stats Cards Grid --}}
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    
    {{-- Card 1: Torneos --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:shadow-md">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Torneos Activos</p>
          <h3 class="mt-1 text-2xl font-bold text-slate-900">{{ $stats['torneos_en_curso'] }}</h3>
          <p class="mt-1 text-xs text-slate-500">{{ $stats['torneos_total'] }} torneos en total</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 border border-amber-100">
          <ion-icon name="trophy-outline" class="text-2xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100">
        <a href="{{ route('admin.torneos.index') }}" class="text-xs font-semibold text-[#59acda] hover:text-[#4396c2] flex items-center gap-1">
          Administrar torneos <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Card 2: Partidos Programados --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:shadow-md">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Próximos Partidos</p>
          <h3 class="mt-1 text-2xl font-bold text-slate-900">{{ $stats['partidos_programados'] }}</h3>
          <p class="mt-1 text-xs text-slate-500">Por disputarse</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-[#59acda] border border-sky-100">
          <ion-icon name="calendar-outline" class="text-2xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100">
        <a href="{{ route('admin.partidos.index', ['estado' => 'programado']) }}" class="text-xs font-semibold text-[#59acda] hover:text-[#4396c2] flex items-center gap-1">
          Ver programación <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Card 3: Partidos Finalizados --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:shadow-md">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Partidos Jugados</p>
          <h3 class="mt-1 text-2xl font-bold text-slate-900">{{ $stats['partidos_finalizados'] }}</h3>
          <p class="mt-1 text-xs text-slate-500">{{ $stats['partidos_total'] }} registrados</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100">
          <ion-icon name="checkmark-done-circle-outline" class="text-2xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100">
        <a href="{{ route('admin.partidos.index', ['estado' => 'finalizado']) }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
          Ver resultados <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

    {{-- Card 4: Clubes --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs transition-all hover:shadow-md">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Clubes Afiliados</p>
          <h3 class="mt-1 text-2xl font-bold text-slate-900">{{ $stats['clubes_total'] }}</h3>
          <p class="mt-1 text-xs text-slate-500">{{ $stats['equipos_total'] }} equipos por cat.</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-purple-600 border border-purple-100">
          <ion-icon name="shield-checkmark-outline" class="text-2xl"></ion-icon>
        </div>
      </div>
      <div class="mt-4 pt-3 border-t border-slate-100">
        <a href="{{ route('admin.clubes.index') }}" class="text-xs font-semibold text-purple-600 hover:text-purple-700 flex items-center gap-1">
          Ver clubes y equipos <ion-icon name="arrow-forward-outline"></ion-icon>
        </a>
      </div>
    </div>

  </div>

  {{-- Two Column Grid: Upcoming matches & Recent results --}}
  <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    
    {{-- Left: Próximos Partidos --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
      <div class="flex items-center justify-between border-b border-slate-100 pb-4">
        <div>
          <h3 class="text-base font-bold text-slate-900">Próximos Partidos</h3>
          <p class="text-xs text-slate-500">Fechas y horarios programados</p>
        </div>
        <a href="{{ route('admin.partidos.index', ['estado' => 'programado']) }}" class="text-xs font-semibold text-[#59acda] hover:underline">
          Ver todos
        </a>
      </div>

      <div class="mt-4 divide-y divide-slate-100">
        @forelse ($proximosPartidos as $partido)
          <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/70 px-2 rounded-xl transition-colors">
            <div class="flex items-center gap-3">
              {{-- Teams --}}
              <div class="space-y-1">
                <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
                  <span>{{ $partido->local->club->nombre ?? 'Local' }}</span>
                  <span class="text-xs font-normal text-slate-400">vs</span>
                  <span>{{ $partido->visitante->club->nombre ?? 'Visitante' }}</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-500">
                  <span class="inline-flex items-center gap-1">
                    <ion-icon name="trophy-outline" class="text-slate-400"></ion-icon>
                    {{ $partido->torneo->nombre ?? 'Torneo' }}
                  </span>
                  <span>•</span>
                  <span>Jornada {{ $partido->jornada ?? '-' }}</span>
                  @if ($partido->estadio)
                    <span>•</span>
                    <span>{{ $partido->estadio->nombre }}</span>
                  @endif
                </div>
              </div>
            </div>

            {{-- Date & Action --}}
            <div class="flex items-center gap-3">
              <div class="text-right">
                <span class="block text-xs font-semibold text-slate-700">
                  {{ $partido->fecha_hora ? $partido->fecha_hora->format('d/m/Y') : 'A definir' }}
                </span>
                <span class="block text-[11px] text-slate-400">
                  {{ $partido->fecha_hora ? $partido->fecha_hora->format('H:i') . ' hs' : '' }}
                </span>
              </div>
              <a
                href="{{ route('admin.partidos.edit', $partido) }}"
                title="Editar y cargar resultado"
                class="rounded-lg p-2 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
                <ion-icon name="create-outline" class="text-lg"></ion-icon>
              </a>
            </div>
          </div>
        @empty
          <div class="py-8 text-center text-slate-400 text-sm">
            <ion-icon name="calendar-outline" class="text-3xl mb-1 text-slate-300"></ion-icon>
            <p>No hay partidos programados próximos.</p>
          </div>
        @endforelse
      </div>
    </div>

    {{-- Right: Últimos Resultados --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
      <div class="flex items-center justify-between border-b border-slate-100 pb-4">
        <div>
          <h3 class="text-base font-bold text-slate-900">Últimos Resultados</h3>
          <p class="text-xs text-slate-500">Partidos recientemente finalizados</p>
        </div>
        <a href="{{ route('admin.partidos.index', ['estado' => 'finalizado']) }}" class="text-xs font-semibold text-[#59acda] hover:underline">
          Ver todos
        </a>
      </div>

      <div class="mt-4 divide-y divide-slate-100">
        @forelse ($ultimosResultados as $partido)
          <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/70 px-2 rounded-xl transition-colors">
            <div class="space-y-1">
              <div class="flex items-center gap-3">
                <span class="font-semibold text-sm text-slate-800">{{ $partido->local->club->nombre ?? 'Local' }}</span>
                <span class="rounded-md bg-slate-900 px-2 py-0.5 text-xs font-bold text-white tracking-wider">
                  {{ $partido->goles_local ?? 0 }} - {{ $partido->goles_visitante ?? 0 }}
                </span>
                <span class="font-semibold text-sm text-slate-800">{{ $partido->visitante->club->nombre ?? 'Visitante' }}</span>
              </div>
              <p class="text-xs text-slate-500">
                {{ $partido->torneo->nombre ?? 'Torneo' }} • Fecha {{ $partido->jornada ?? '-' }}
              </p>
            </div>

            <div class="flex items-center gap-2">
              <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-medium text-slate-600">
                Finalizado
              </span>
              <a
                href="{{ route('admin.partidos.edit', $partido) }}"
                title="Editar resultado"
                class="rounded-lg p-2 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
                <ion-icon name="create-outline" class="text-lg"></ion-icon>
              </a>
            </div>
          </div>
        @empty
          <div class="py-8 text-center text-slate-400 text-sm">
            <ion-icon name="football-outline" class="text-3xl mb-1 text-slate-300"></ion-icon>
            <p>No se han registrado resultados recientemente.</p>
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
        <div class="rounded-xl border border-slate-200/90 bg-gradient-to-br from-white to-slate-50/60 p-4 transition-all hover:border-[#59acda]/60 hover:shadow-sm">
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
