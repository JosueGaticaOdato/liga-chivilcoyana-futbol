<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/icono.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Mi Sitio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS especifico por vista --}}
    @stack('styles')

    {{-- Ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>

    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')

</body>

</html>
