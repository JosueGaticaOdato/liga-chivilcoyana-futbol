<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="{{ asset('images/icono.ico') }}" type="image/x-icon">
  <title>@yield('title', 'Admin') | Liga Chivilcoyana de Fútbol</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Ionicons --}}
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  @stack('styles')
</head>

<body class="h-full font-sans antialiased text-slate-800 bg-[#f8fafc]">

  <div class="min-h-full flex">
    
    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Container (shifted right by sidebar on desktop) --}}
    <div class="flex flex-1 flex-col lg:pl-72 min-w-0">
      
      {{-- Top Navbar --}}
      @include('admin.partials.navbar')

      {{-- Page Content --}}
      <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
        
        {{-- Flash Alerts --}}
        @include('admin.partials.alerts')

        {{-- Yielded Content --}}
        @yield('content')

      </main>

      {{-- Admin Footer --}}
      <footer class="border-t border-slate-200/80 bg-white px-6 py-4 text-center text-xs text-slate-500">
        <p>© {{ date('Y') }} Liga Chivilcoyana de Fútbol – Panel de Administración Oficial.</p>
      </footer>

    </div>

  </div>

  {{-- General Admin Scripts --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('admin-sidebar');
      const backdrop = document.getElementById('sidebar-backdrop');
      const openBtn = document.getElementById('open-sidebar-btn');
      const closeBtn = document.getElementById('close-sidebar-btn');

      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
      }

      function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
      }

      if (openBtn) openBtn.addEventListener('click', openSidebar);
      if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
      if (backdrop) backdrop.addEventListener('click', closeSidebar);
    });
  </script>

  @stack('scripts')
</body>

</html>
