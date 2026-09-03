<aside
  id="admin-sidebar"
  class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-[#121e36] text-slate-200 transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full shadow-2xl border-r border-slate-800/80">
  
  {{-- Header / Logo --}}
  <div class="flex h-24 items-center justify-between px-6 border-b border-slate-800 bg-[#0c1527]">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
      <img
        src="{{ asset('images/logo.png') }}"
        alt="Logo Liga Chivilcoyana"
        class="h-12 w-auto object-contain transition-transform group-hover:scale-105">
      <div>
        <span class="block text-xs uppercase tracking-widest text-[#59acda] font-semibold">Panel Admin</span>
        <span class="block text-base font-bold text-white leading-tight">Liga Chivilcoy</span>
      </div>
    </a>

    {{-- Close mobile button --}}
    <button
      type="button"
      id="close-sidebar-btn"
      class="lg:hidden rounded-lg p-2 text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
      <ion-icon name="close-outline" class="text-2xl"></ion-icon>
    </button>
  </div>

  {{-- Nav Items --}}
  <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5 custom-scrollbar">
    
    <div class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
      Gestión Principal
    </div>

    {{-- Dashboard --}}
    <a
      href="{{ route('admin.dashboard') }}"
      class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'bg-[#59acda] text-white shadow-lg shadow-[#59acda]/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
      <ion-icon name="grid-outline" class="text-xl"></ion-icon>
      <span>Dashboard</span>
    </a>

    {{-- Torneos --}}
    <a
      href="{{ route('admin.torneos.index') }}"
      class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.torneos.*') ? 'bg-[#59acda] text-white shadow-lg shadow-[#59acda]/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
      <ion-icon name="trophy-outline" class="text-xl"></ion-icon>
      <span>Torneos</span>
    </a>

    {{-- Partidos --}}
    <a
      href="{{ route('admin.partidos.index') }}"
      class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.partidos.*') ? 'bg-[#59acda] text-white shadow-lg shadow-[#59acda]/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
      <ion-icon name="football-outline" class="text-xl"></ion-icon>
      <span>Partidos y Resultados</span>
    </a>

    <div class="pt-5 px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
      Institucional
    </div>

    {{-- Clubes --}}
    <a
      href="{{ route('admin.clubes.index') }}"
      class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.clubes.*') ? 'bg-[#59acda] text-white shadow-lg shadow-[#59acda]/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
      <ion-icon name="shield-outline" class="text-xl"></ion-icon>
      <span>Clubes</span>
    </a>

    {{-- Equipos --}}
    <a
      href="{{ route('admin.equipos.index') }}"
      class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.equipos.*') ? 'bg-[#59acda] text-white shadow-lg shadow-[#59acda]/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
      <ion-icon name="people-outline" class="text-xl"></ion-icon>
      <span>Equipos por Categoría</span>
    </a>

  </div>

  {{-- Footer info / Public Web Link --}}
  <div class="border-t border-slate-800 p-4 bg-[#0c1527]/70">
    <a
      href="{{ route('home') }}"
      target="_blank"
      class="flex items-center justify-between rounded-xl bg-slate-800/90 px-4 py-3 text-xs font-semibold text-slate-300 hover:bg-[#59acda] hover:text-white transition-all shadow-sm group">
      <span class="flex items-center gap-2">
        <ion-icon name="globe-outline" class="text-base text-[#59acda] group-hover:text-white transition-colors"></ion-icon>
        Ver Web Pública
      </span>
      <ion-icon name="open-outline" class="text-sm opacity-60 group-hover:opacity-100"></ion-icon>
    </a>
  </div>

</aside>

{{-- Mobile overlay backdrop --}}
<div
  id="sidebar-backdrop"
  class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 hidden lg:hidden">
</div>
