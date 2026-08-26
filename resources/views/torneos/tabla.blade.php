@extends('layouts.app')

@section('title', content: 'Tabla de posiciones - ' . $torneo->nombre . ' ' . $torneo->temporada->nombre)

@section('content')

    <x-header-main title="Torneo {{ $torneo->nombre }} {{ $torneo->temporada->nombre }}" subtitle="Tabla de posiciones"/>

    <section class="w-full flex flex-col gap-6 pb-8">

        @if ($tabla->isEmpty())
            <p>No hay datos de tabla disponibles.</p>
        @endif

        <article>

            <div class="w-full overflow-x-auto [webkit-overflow-scrolling:touch]">
                <x-tabla-posiciones :equipos="$tabla"/>
            </div>

        </article>

        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 md:w-[90%] lg:w-[80%] mx-auto">

            <article class="bg-(--color-blanco) rounded-xl p-4 px-5">
                <h3 class="text-[1.1rem] md:text-[1.2rem] font-black pb-2 text-left">
                    Criterio de clasificacion
                </h3>

                <ul class="flex flex-col gap-3 py-2">
                    <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
                        <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
                        Mayor cantidad de puntos obtenidos
                    </li>

                    <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
                        <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
                        Mejor diferencia de gol
                    </li>

                    <li class="flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base">
                        <ion-icon name="checkmark-circle-outline" class="text-[0.9rem] text-(--color-blanco) bg-(--color-primario) rounded-full"></ion-icon>
                        Mayor cantidad de goles a favor
                    </li>
                </ul>
            </article>

            <article class="bg-(--color-blanco) rounded-xl p-4 px-5">
                <h3 class="text-[1.1rem] md:text-[1.2rem] font-black pb-2 text-left">
                    Referencias
                </h3>

                <ul class="flex flex-col gap-3 py-2">
                    <li class="clasificado flex gap-2 items-center text-(--color-letras-primario) text-[0.95rem] md:text-base before:content-[''] before:w-3 before:h-3 before:bg-(--color-success) before:rounded-full lg:before:w-4 lg:before:h-4">
                        Clasificado a PlayOff
                    </li>
                </ul>
            </article>

        </div>
    </section>

@endsection