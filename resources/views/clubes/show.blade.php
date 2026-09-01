@extends('layouts.app')

@section('title', 'Club ' . $club->nombre)

@section('content')

<x-header-main
  title="{{ $club->nombre_institucional }}"
  image="{{ asset('storage/' . $club->escudo) }}"
  imageAlt="Escudo {{ $club->nombre }}" />

<section class="grid grid-cols-1 gap-8 mx-4 lg:grid-cols-[2fr_1fr] lg:p-8">

  {{-- =========================================
      COLUMNA IZQUIERDA
  ========================================== --}}
  <div>

    {{-- SOBRE EL CLUB --}}
    <section
      class="bg-(--color-blanco) rounded-2xl p-6 shadow-(--sombra-suave) mb-4">

      <header class="mb-4">
        <h2 class="flex items-center gap-2 text-[1.4rem] font-extrabold">
          <ion-icon
            name="alert-circle-outline"
            class="text-[1.5rem] font-extrabold text-(--color-primario)"></ion-icon>

          Sobre el Club
        </h2>
      </header>

      <article class="mb-6">
        <p>
          {{ $club->descripcion }}
        </p>
      </article>

      <ul class="flex flex-col gap-4 lg:flex-row lg:justify-evenly">

        <li
          class="bg-(--color-bg-muted) rounded-xl w-full p-4 text-center">
          <span
            class="block mb-1 text-xs uppercase text-(--color-letras-cuaternario)">
            Fundación
          </span>

          <strong
            class="text-base text-(--color-letras-primario)">
            {{ $club->fecha_fundacion }}
          </strong>
        </li>

        @if (isset($club->estadio))
        <li
          class="bg-(--color-bg-muted) rounded-xl w-full p-4 text-center">
          <span
            class="block mb-1 text-xs uppercase text-(--color-letras-cuaternario)">
            Estadio
          </span>

          <strong
            class="text-base text-(--color-letras-primario)">
            {{ $club->estadio->nombre }}
          </strong>
        </li>
        @endif

      </ul>

    </section>


    {{-- ULTIMOS RESULTADOS --}}
    @if (isset($ultimosPartidos) && count($ultimosPartidos) > 0)

    <section
      class="bg-(--color-blanco) rounded-2xl p-6 shadow-(--sombra-suave)">

      <header class="mb-4">
        <h2 class="text-[1.4rem] font-extrabold flex items-center gap-2">
          <ion-icon
            name="football-outline"
            class="text-[1.5rem] font-extrabold text-(--color-primario)"></ion-icon>

          Últimos Resultados
        </h2>
      </header>


      <ul class="grid gap-3">

        @foreach ($ultimosPartidos as $partido)

        @php
        $esLocal = $partido->local->id === $club->id;

        $golesEquipo = $esLocal
        ? $partido->goles_local
        : $partido->goles_visitante;

        $golesRival = $esLocal
        ? $partido->goles_visitante
        : $partido->goles_local;

        if ($golesEquipo > $golesRival) {
        $resultado = 'Victoria';
        $clase = 'border-l-4 border-[var(--color-success)]';
        $colorResultado = 'text-[var(--color-success)]';
        } elseif ($golesEquipo < $golesRival) {
          $resultado='Derrota' ;
          $clase='border-l-4 border-[var(--color-error)]' ;
          $colorResultado='text-[var(--color-error)]' ;
          } else {
          $resultado='Empate' ;
          $clase='border-l-4 border-[var(--color-warning)]' ;
          $colorResultado='text-[var(--color-warning)]' ;
          }

          $rival=$esLocal
          ? $partido->visitante
          : $partido->local;
          @endphp


          <li>

            <a
              href="{{ route('partidos.show', $partido) }}"
              class="
                                    flex flex-col items-center gap-3
                                    bg-(--color-bg-muted)
                                    px-4 py-3
                                    rounded-xl
                                    text-sm
                                    {{ $clase }}

                                    md:grid
                                    md:grid-cols-[4rem_1fr_auto_1fr_auto]
                                ">

              <time
                datetime="{{ $partido->fecha_hora->format('Y-m-d H:i') }}"
                class="text-xs text-(--color-letras-cuaternario)"
                {{ $partido->fecha_hora->translatedFormat('d/m/Y') }}
                </time>


                <span
                  class=" text-(--color-letras-primario) md:text-right">
                  {{ $club->nombre }}
                </span>


                <strong class="font-semibold">
                  {{ $golesEquipo }} - {{ $golesRival }}
                </strong>


                <span
                  class="text-(--color-letras-primario)">
                  {{ $partido->visitante->club->nombre }}
                </span>


                <span
                  class="
                                        text-[0.7rem]
                                        px-2 py-1
                                        rounded-full
                                        font-semibold
                                        uppercase
                                        {{ $colorResultado }}
                                    ">
                  {{ $resultado }}
                </span>

            </a>

          </li>

          @endforeach

      </ul>

    </section>

    @endif

  </div>


  {{-- COLUMNA DERECHA --}}
  @if (isset($torneo))

  <div>

    {{-- POSICIÓN --}}
    <section
      class="
                    text-left
                    bg-(--color-primario)
                    text-(--color-letras-secundario)
                    rounded-2xl
                    p-6
                    shadow-(--sombra-suave)
                    mb-4
                ">

      <h2 class="text-[1.4rem] font-extrabold">
        Posición Actual - {{ $torneo->nombre }}
      </h2>


      <p
        class="
                        text-base
                        text-(--color-letras-secundario)
                        py-[1.4rem]
                    ">
        <strong
          class="
                            text-5xl
                            font-extrabold
                            text-(--color-letras-secundario)
                        ">
          {{ $posicion }}°
        </strong>

        / {{ $totalEquipos }} Equipos
      </p>


      <ul
        class="
                        grid
                        grid-cols-3
                        gap-3
                        border-t
                        border-(--color-blanco)
                        pt-4
                    ">

        <li class="p-3">
          <strong class="block text-3xl font-extrabold">
            {{ $equipoTabla->puntos }}
          </strong>

          <span class="text-base uppercase">
            Puntos
          </span>
        </li>


        <li class="p-3">
          <strong class="block text-3xl font-extrabold">
            {{ $equipoTabla->partidos_jugados }}
          </strong>

          <span class="text-base uppercase">
            Jugados
          </span>
        </li>


        <li class="p-3">
          <strong class="block text-3xl font-extrabold">
            {{ $equipoTabla->diferencia_goles > 0 ? '+' : '' }}{{ $equipoTabla->diferencia_goles }}
          </strong>

          <span class="text-base uppercase">
            Diferencia
          </span>
        </li>

      </ul>

    </section>


    {{-- PRÓXIMO PARTIDO --}}
    <section
      class="
                    bg-(--color-blanco)
                    rounded-2xl
                    p-6
                    shadow-(--sombra-suave)
                    grid
                    grid-cols-1
                    justify-items-center
                    mb-4
                ">

      <h2
        class="
                        text-[1.4rem]
                        font-extrabold
                        text-left
                        w-full
                    ">
        Próximo Partido
      </h2>


      @if ($proximoPartido)

      <x-partido-card :partido="$proximoPartido" />

      @else

      <p class="pt-4">
        No hay partidos programados.
      </p>

      @endif

    </section>

  </div>

  @endif

</section>
@endsection