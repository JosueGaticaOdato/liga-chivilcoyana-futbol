<header class="sticky top-0 z-20 flex h-20 w-full items-center justify-between border-b border-slate-200/80 bg-white/80 px-6 backdrop-blur-md transition-all">
  
  {{-- Left: Toggle mobile & Breadcrumbs --}}
  <div class="flex items-center gap-4">
    <button
      type="button"
      id="open-sidebar-btn"
      class="rounded-xl p-2 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors lg:hidden focus:outline-none focus:ring-2 focus:ring-[#59acda]">
      <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
    </button>

    <div class="flex flex-col">
      <h1 class="text-lg font-bold text-slate-900 leading-tight">
        @yield('page_title', 'Panel de Administración')
      </h1>
      <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#59acda] transition-colors">Admin</a>
        @yield('breadcrumbs')
      </div>
    </div>
  </div>

  {{-- Right: Quick Action Buttons & Status --}}
  <div class="flex items-center gap-3">
    
    <div class="hidden sm:flex items-center gap-2">
      <a
        href="{{ route('admin.partidos.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
        <ion-icon name="add-circle-outline" class="text-base"></ion-icon>
        <span>Cargar Partido</span>
      </a>
      
      <a
        href="{{ route('admin.torneos.create') }}"
        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-xs hover:bg-slate-50 hover:text-slate-900 transition-colors">
        <ion-icon name="trophy-outline" class="text-base text-[#59acda]"></ion-icon>
        <span>Nuevo Torneo</span>
      </a>
    </div>

  </div>

</header>
