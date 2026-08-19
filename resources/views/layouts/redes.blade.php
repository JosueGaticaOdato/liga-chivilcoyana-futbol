<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/icono.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Liga Chivilcoyana de Futbol')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS especifico por vista --}}
    @stack('styles')
</head>

<body>

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        document.getElementById('btn-descargar').addEventListener('click', function() {

            const elemento = document.getElementById('captura');

            html2canvas(elemento, {
                scale: 2,
                useCORS: true,
                backgroundColor: null
            }).then(canvas => {
                let enlace = document.createElement('a');

                enlace.download = 'tabla-posiciones.png';

                enlace.href = canvas.toDataURL('image/png');

                enlace.click();
            });
        });
    </script>
</body>

</html>
