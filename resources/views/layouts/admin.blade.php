<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/icono.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Admin - Liga Chivilcoyana de Futbol')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS especifico por vista --}}
    @stack('styles')

    {{-- Ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "rgb(97, 174, 218)",
                        primaryDark: "rgb(70, 140, 180)",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "text-light": "#1e293b",
                        "text-dark": "#f1f5f9",
                    },
                    fontFamily: {
                        display: ["Roboto", "sans-serif"],
                        body: ["Roboto", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply transition-colors duration-300;
            }
        }

        .sidebar-link-active {
            @apply bg-primary text-white;
        }

        .main-content-height {
            min-height: calc(100vh - 80px - 300px);
        }
    </style>
</head>

<body>

    @include('partials.headerAdmin')

    <main class="admin-layout">
        @include('partials.aside')
        <main class="admin-main">
            @yield('content')
        </main>
    </main>
    {{-- <main>
        @include('partials.example')
    </main> --}}

    @include('partials.example')

    {{-- @include('partials.footer') --}}
</body>

</html>
