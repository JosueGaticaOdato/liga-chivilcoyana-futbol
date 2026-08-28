@extends('layouts.app')

@section('title', 'Partido')

@section('content')

<x-header-main 
    title="Torneo {{ $partido->torneo->nombre }}"
    subtitle="Fecha {{ $partido->jornada }}"
/>

<section class="flex flex-col gap-4 p-4 bg-(--color-blanco) rounded-xl border-l-8 border-(--color-primario) border-b-[5px] border-b-transparent shadow-(--sombra-suave) m-4 lg:w-[90%] lg:max-w-300 lg:mx-auto">
  <h2 class="text-2xl font-black">
    Datos del partido
  </h2>

  <ul class="flex flex-col gap-2 w-full justify-evenly lg:flex-row">
    <li class="flex flex-row items-center gap-4">
      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="calendar-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Fecha
        </h4>

        <p class="text-base font-black">
          {{ $partido->fecha_hora?->translatedFormat('d \d\e F, Y') }}         
        </p>
      </div>
    </li>

    <li class="flex flex-row items-center gap-4">
      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="time-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Hora
        </h4>

        <p class="text-base font-black">
          {{ ($partido->fecha_hora)->format('H:i') }} Hs.
        </p>
      </div>
    </li>


    <li class="flex flex-row items-center gap-4">
      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="location-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Estadio
        </h4>

        <p class="text-base font-black">
          {{ $partido->estadio->nombre ?? 'A definir' }}
        </p>
      </div>
    </li>

    <li class="flex flex-row items-center gap-4">
      <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-(--color-degradado-1) to-(--color-degradado-2) text-(--color-blanco)">
        <ion-icon name="football-outline" class="text-[2rem]"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Torneo
        </h4>

        <p class="text-base font-black">
          {{ $partido->torneo->nombre }} {{ $partido->torneo->temporada->nombre }}
        </p>
      </div>
    </li>
  </ul>
</section>


<!-- @if ($partido->fechaPartido && $partido->horaPartido)
<section class="flex flex-col gap-4 p-4 bg-(--color-blanco) rounded-xl border-l-8 border-(--color-primario) border-b-[5px] border-b-transparent shadow-(--sombra-suave) m-4 lg:w-[90%] lg:max-w-300 lg:mx-auto">
  <h2 class="text-2xl font-black">
    Clima del partido
  </h2>

  <ul class="flex flex-col gap-2 w-full justify-evenly lg:flex-row">
    @if ($clima)

    <li class="flex flex-row items-center gap-4">
      <span class="flex items-center justify-center">
        <img
          src="https://openweathermap.org/img/wn/{{ data_get($clima, 'weather.0.icon') }}@4x.png"
          alt="Clima"
          class="w-18 h-18 object-contain">
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Estado
        </h4>

        <p class="text-base font-black">
          {{ ucfirst(data_get($clima, 'weather.0.description')) }}
        </p>
      </div>
    </li>

    <li class="flex flex-row items-center gap-4">
      <span class="flex items-center justify-center">
        <ion-icon name="thermometer-outline" class="text-(--color-primario)"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Temperatura
        </h4>

        <p class="text-base font-black">
          {{ round(data_get($clima, 'temp.day'), 1) }}°C
        </p>
      </div>
    </li>

    <li class="flex flex-row items-center gap-4">
      <span class="flex items-center justify-center">
        <ion-icon name="water-outline" class="text-(--color-primario)"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Humedad
        </h4>

        <p class="text-base font-black">
          {{ data_get($clima, 'humidity') }}%
        </p>
      </div>
    </li>

    @else

    <li class="flex flex-row items-center gap-4">
      <span class="flex items-center justify-center">
        <ion-icon name="help-circle-outline" class="text-(--color-primario)"></ion-icon>
      </span>

      <div>
        <h4 class="uppercase text-[0.9rem] font-bold text-(--color-letras-cuaternario) pb-[0.3rem]">
          Aviso
        </h4>

        <p class="text-base font-black">
          No disponible
        </p>
      </div>
    </li>

    @endif
  </ul>
</section>
@endif -->


<article class="flex items-stretch justify-between m-4 p-4 bg-(--color-blanco) rounded-xl shadow-(--sombra-suave) md:p-5 md:px-6 md:gap-4 lg:w-[90%] lg:max-w-300 lg:mx-auto lg:p-6 lg:px-8">

  <!-- Equipo Local -->
  <section class="flex-1 text-center">
    <header class="flex flex-col items-center gap-2 lg:gap-3">
      <figure class="w-15 h-17.5 rounded-full flex items-center justify-center md:w-24 md:h-28 lg:w-40 lg:h-44">
        <img
          src="{{ asset('storage/' . $partido->local->club->escudo) }}"
          alt="Escudo {{ $partido->local->club->nombre }}"
          class="w-full h-full object-contain">
      </figure>

      <h2 class="text-sm font-semibold md:text-base lg:text-[1.2rem]">
        {{ $partido->local->club->nombre }}
      </h2>

      <p class="text-xs text-(--color-letras-cuaternario)">
        Local
      </p>
    </header>
  </section>


  <!-- Resultado y estado -->
  <section class="flex flex-col items-center justify-around self-stretch gap-1 text-2xl font-extrabold text-(--color-letras-cuaternario) mx-4 after:content-[''] after:block">

    <span class="text-xs font-bold py-1 px-3 rounded uppercase text-(--color-letras-secundario) {{ match($partido->estado) {
            'en_vivo' => 'bg-(--color-error) shadow-[0_0_5px_rgba(239,68,68,0.5)]',
            'programado' => 'bg-(--color-stay)',
            'finalizado' => 'bg-(--color-primario)',
            default => ''
        } }}">
      {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
    </span>

    @if ($partido->estado === 'programado')

    <span class="text-[2.5rem] md:text-5xl font-bold">
      VS
    </span>

    @else

    <p class="text-[2.5rem] md:text-5xl font-bold" aria-label="Resultado del partido">
      <span>{{ $partido->goles_local ?? 0 }}</span>
      <span>-</span>
      <span>{{ $partido->goles_visitante ?? 0 }}</span>
    </p>

    @endif

  </section>


  <!-- Equipo Visitante -->
  <section class="flex-1 text-center">
    <header class="flex flex-col items-center gap-2 lg:gap-3">
      <figure class="w-15 h-17.5 rounded-full flex items-center justify-center md:w-24 md:h-28 lg:w-40 lg:h-44">
        <img
          src="{{ asset('storage/' . $partido->visitante->club->escudo) }}"
          alt="Escudo {{ $partido->visitante->nombre }}"
          class="w-full h-full object-contain">
      </figure>

      <h2 class="text-sm font-semibold md:text-base lg:text-[1.2rem]">
        {{ $partido->visitante->club->nombre }}
      </h2>

      <p class="text-xs text-(--color-letras-cuaternario)">
        Visitante
      </p>
    </header>
  </section>

</article>

@endsection