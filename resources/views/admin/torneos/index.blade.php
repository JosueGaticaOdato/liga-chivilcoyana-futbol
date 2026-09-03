@extends('admin.layouts.app')

@section('title', 'Torneos')
@section('page_title', 'Gestión de Torneos')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Torneos</span>
@endsection

@section('content')
<div class="space-y-6">

  {{-- Header with action button --}}
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Listado de Torneos</h2>
      <p class="text-xs text-slate-500">Administra las competencias oficiales, sus estados y calendarios.</p>
    </div>
    <a
      href="{{ route('admin.torneos.create') }}"
      class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-all transform hover:-translate-y-0.5">
      <ion-icon name="add-circle-outline" class="text-lg"></ion-icon>
      Nuevo Torneo
    </a>
  </div>

  {{-- Filter bar --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-xs">
    <form method="GET" action="{{ route('admin.torneos.index') }}" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
      
      {{-- Search --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Buscar por nombre</label>
        <div class="relative">
          <input
            type="text"
            name="buscar"
            value="{{ request('buscar') }}"
            placeholder="Ej: Apertura, Clausura..."
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>
      </div>

      {{-- Temporada --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Temporada</label>
        <select
          name="temporada_id"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todas las temporadas</option>
          @foreach ($temporadas as $temp)
            <option value="{{ $temp->id }}" {{ request('temporada_id') == $temp->id ? 'selected' : '' }}>
              {{ $temp->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Categoria --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Categoría</label>
        <select
          name="categoria_id"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todas las categorías</option>
          @foreach ($categorias as $cat)
            <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
              {{ $cat->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Estado & Submit --}}
      <div class="flex items-end gap-2">
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-600 mb-1">Estado</label>
          <select
            name="estado"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
            <option value="">Todos los estados</option>
            <option value="en_curso" {{ request('estado') === 'en_curso' ? 'selected' : '' }}>En Curso</option>
            <option value="planificado" {{ request('estado') === 'planificado' ? 'selected' : '' }}>Planificado</option>
            <option value="finalizado" {{ request('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
          </select>
        </div>
        <button
          type="submit"
          class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition-colors">
          Filtrar
        </button>
        @if (request()->hasAny(['buscar', 'temporada_id', 'categoria_id', 'estado']))
          <a
            href="{{ route('admin.torneos.index') }}"
            class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
            Limpiar
          </a>
        @endif
      </div>

    </form>
  </div>

  {{-- Torneos Table --}}
  <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-xs">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50/80 text-slate-600 uppercase tracking-wider font-semibold border-b border-slate-200">
          <tr>
            <th class="px-5 py-3.5">Torneo / Slug</th>
            <th class="px-5 py-3.5">Categoría</th>
            <th class="px-5 py-3.5">Temporada</th>
            <th class="px-5 py-3.5">Fechas</th>
            <th class="px-5 py-3.5">Partidos</th>
            <th class="px-5 py-3.5">Estado</th>
            <th class="px-5 py-3.5 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($torneos as $torneo)
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="px-5 py-4">
                <div class="font-bold text-sm text-slate-900">{{ $torneo->nombre }}</div>
                <div class="text-[11px] text-slate-400 font-mono">{{ $torneo->slug }}</div>
              </td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 font-medium text-slate-700">
                  {{ $torneo->categoria->nombre ?? 'N/A' }}
                </span>
              </td>
              <td class="px-5 py-4 font-medium text-slate-700">
                {{ $torneo->temporada->nombre ?? 'N/A' }}
              </td>
              <td class="px-5 py-4 text-slate-600">
                <div>Ini: {{ $torneo->fecha_inicio ? $torneo->fecha_inicio->format('d/m/Y') : '-' }}</div>
                <div>Fin: {{ $torneo->fecha_fin ? $torneo->fecha_fin->format('d/m/Y') : '-' }}</div>
              </td>
              <td class="px-5 py-4">
                <a
                  href="{{ route('admin.partidos.index', ['torneo_id' => $torneo->id]) }}"
                  class="inline-flex items-center gap-1 font-semibold text-[#59acda] hover:underline">
                  <ion-icon name="football-outline"></ion-icon>
                  {{ $torneo->partidos_count }} partidos
                </a>
              </td>
              <td class="px-5 py-4">
                @if ($torneo->estado === 'en_curso')
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    En Curso
                  </span>
                @elseif ($torneo->estado === 'planificado')
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                    Planificado
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">
                    Finalizado
                  </span>
                @endif
              </td>
              <td class="px-5 py-4 text-right">
                <div class="inline-flex items-center gap-1">
                  {{-- View public tournament page --}}
                  <a
                    href="{{ route('torneos.torneo', $torneo->slug) }}"
                    target="_blank"
                    title="Ver en web pública"
                    class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition-colors">
                    <ion-icon name="eye-outline" class="text-base"></ion-icon>
                  </a>

                  {{-- Edit --}}
                  <a
                    href="{{ route('admin.torneos.edit', $torneo) }}"
                    title="Editar torneo"
                    class="rounded-lg p-2 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
                    <ion-icon name="create-outline" class="text-base"></ion-icon>
                  </a>

                  {{-- Delete --}}
                  <form
                    action="{{ route('admin.torneos.destroy', $torneo) }}"
                    method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar el torneo {{ $torneo->nombre }}? Esta acción no se puede deshacer.');"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      title="Eliminar torneo"
                      class="rounded-lg p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                      <ion-icon name="trash-outline" class="text-base"></ion-icon>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-10 text-center text-slate-400">
                <ion-icon name="trophy-outline" class="text-4xl mb-2 text-slate-300"></ion-icon>
                <p class="font-medium">No se encontraron torneos registrados.</p>
                <p class="text-[11px] text-slate-400">Prueba ajustando los filtros o crea un nuevo torneo.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($torneos->hasPages())
      <div class="border-t border-slate-200 px-5 py-4 bg-slate-50/50">
        {{ $torneos->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
