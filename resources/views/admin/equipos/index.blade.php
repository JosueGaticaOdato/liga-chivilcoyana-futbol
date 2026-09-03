@extends('admin.layouts.app')

@section('title', 'Equipos por Categoría')
@section('page_title', 'Gestión de Equipos')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.clubes.index') }}" class="hover:text-[#59acda] transition-colors">Clubes</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Equipos</span>
@endsection

@section('content')
<div class="space-y-6">

  {{-- Header with action button --}}
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Equipos por Categoría</h2>
      <p class="text-xs text-slate-500">Asigna y administra los planteles de cada club en sus respectivas divisiones (Primera, Sub-17, etc.).</p>
    </div>
    <a
      href="{{ route('admin.equipos.create') }}"
      class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#59acda] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-all transform hover:-translate-y-0.5">
      <ion-icon name="add-circle-outline" class="text-lg"></ion-icon>
      Registrar Equipo
    </a>
  </div>

  {{-- Filter bar --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-xs">
    <form method="GET" action="{{ route('admin.equipos.index') }}" class="grid grid-cols-1 gap-3 sm:grid-cols-3 lg:grid-cols-4">
      
      {{-- Club --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Club</label>
        <select
          name="club_id"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todos los clubes</option>
          @foreach ($clubes as $club)
            <option value="{{ $club->id }}" {{ request('club_id') == $club->id ? 'selected' : '' }}>
              {{ $club->nombre }}
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

      {{-- Estado --}}
      <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Estado</label>
        <select
          name="activo"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-xs text-slate-800 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          <option value="">Todos</option>
          <option value="1" {{ request('activo') === '1' ? 'selected' : '' }}>Activos</option>
          <option value="0" {{ request('activo') === '0' ? 'selected' : '' }}>Inactivos</option>
        </select>
      </div>

      {{-- Submit --}}
      <div class="flex items-end gap-2">
        <button
          type="submit"
          class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition-colors w-full sm:w-auto">
          Filtrar
        </button>
        @if (request()->hasAny(['club_id', 'categoria_id', 'activo']))
          <a
            href="{{ route('admin.equipos.index') }}"
            class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
            Limpiar
          </a>
        @endif
      </div>

    </form>
  </div>

  {{-- Equipos Table --}}
  <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-xs">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50/80 text-slate-600 uppercase tracking-wider font-semibold border-b border-slate-200">
          <tr>
            <th class="px-5 py-3.5">Club Institucional</th>
            <th class="px-5 py-3.5">Nombre en Torneo</th>
            <th class="px-5 py-3.5">Categoría / División</th>
            <th class="px-5 py-3.5">Estado</th>
            <th class="px-5 py-3.5 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($equipos as $equipo)
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-9 w-9 shrink-0 rounded-lg bg-slate-100 p-0.5 border border-slate-200 flex items-center justify-center overflow-hidden">
                    @if ($equipo->club && $equipo->club->escudo)
                      <img
                        src="{{ asset('storage/' . $equipo->club->escudo) }}"
                        alt="{{ $equipo->club->nombre }}"
                        class="h-full w-full object-contain">
                    @else
                      <ion-icon name="shield-outline" class="text-base text-slate-400"></ion-icon>
                    @endif
                  </div>
                  <div>
                    <div class="font-bold text-sm text-slate-900">{{ $equipo->club->nombre ?? 'Sin Club' }}</div>
                    <div class="text-[11px] text-slate-400">{{ $equipo->club->nombre_institucional ?? '' }}</div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 font-semibold text-slate-800 text-sm">
                {{ $equipo->nombre }}
              </td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center rounded-lg bg-[#59acda]/10 px-2.5 py-1 font-semibold text-[#307fa8]">
                  {{ $equipo->categoria->nombre ?? 'N/A' }}
                </span>
              </td>
              <td class="px-5 py-4">
                @if ($equipo->activo)
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Habilitado
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500">
                    Inactivo
                  </span>
                @endif
              </td>
              <td class="px-5 py-4 text-right">
                <div class="inline-flex items-center gap-1">
                  <a
                    href="{{ route('admin.equipos.edit', $equipo) }}"
                    title="Editar equipo"
                    class="rounded-lg p-2 text-slate-400 hover:bg-[#59acda]/10 hover:text-[#59acda] transition-colors">
                    <ion-icon name="create-outline" class="text-base"></ion-icon>
                  </a>

                  <form
                    action="{{ route('admin.equipos.destroy', $equipo) }}"
                    method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar el equipo {{ $equipo->nombre }} ({{ $equipo->categoria->nombre ?? '' }})?');"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      title="Eliminar equipo"
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
                <ion-icon name="people-outline" class="text-4xl mb-2 text-slate-300"></ion-icon>
                <p class="font-medium">No se encontraron equipos registrados.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($equipos->hasPages())
      <div class="border-t border-slate-200 px-5 py-4 bg-slate-50/50">
        {{ $equipos->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
