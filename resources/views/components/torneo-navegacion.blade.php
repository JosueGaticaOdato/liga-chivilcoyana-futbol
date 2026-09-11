@props(['torneo'])

@php
    $secciones = [
        [
            'nombre' => 'Resumen',
            'ruta' => 'torneos.torneo',
            'icono' => 'information-circle-outline',
        ],
        [
            'nombre' => 'Tabla de Posiciones',
            'ruta' => 'torneos.tabla',
            'icono' => 'stats-chart-outline',
        ],
        [
            'nombre' => 'Fixture',
            'ruta' => 'torneos.fixture',
            'icono' => 'calendar-outline',
        ],
    ];

    $baseClasses = 'flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold transition-all duration-300';

    $activeClasses = 'bg-(--color-primario) text-(--color-blanco) shadow-(--sombra-suave)';

    $inactiveClasses = 'bg-(--color-blanco) text-(--color-letras-primario) shadow-(--sombra-ultra-suave) hover:bg-(--color-primario) hover:text-(--color-blanco) hover:shadow-(--sombra-suave)';
@endphp

<nav class="flex items-center justify-start gap-3 overflow-x-auto pb-4 px-4 flex-nowrap lg:justify-center">
    @foreach ($secciones as $seccion)
        @php
            $activo = request()->routeIs($seccion['ruta'] . '*');
        @endphp

        <a
            href="{{ route($seccion['ruta'], $torneo->slug) }}"
            class="{{ $baseClasses }} {{ $activo ? $activeClasses : $inactiveClasses }} shrink-0 whitespace-nowrap"
        >
            <ion-icon
                name="{{ $seccion['icono'] }}"
                class="shrink-0 text-lg"
            ></ion-icon>

            {{ $seccion['nombre'] }}
        </a>
    @endforeach
</nav>