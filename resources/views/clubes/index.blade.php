@extends('layouts.app')

@section('title', 'Clubes')

@section('content')

<x-header-main title="Clubes" />

<section class="grid grid-cols-1 gap-5 px-4 pb-4 md:grid-cols-2 md:gap-6 lg:grid-cols-3">

  @foreach ($clubes as $club)
  <a href="{{ route('clubes.show', $club->slug) }}" class="group">

    <article
      class="
        flex h-24 items-center gap-4 overflow-hidden
        rounded-lg
        border-l-[6px] border-l-(--color-primario)
        border-b-[5px] border-b-transparent
        bg-(--color-blanco)
        shadow-(--sombra-ultra-suave)
        transition-all duration-300 ease-in-out

        md:h-28
        md:border-l-8

        lg:hover:-translate-y-1.25
        lg:hover:border-b-(--color-primario)
        lg:hover:shadow-(--sombra-suave)
      ">
      <figure class="h-18 w-22 shrink-0 transition-transform duration-300 ease-in-out md:h-24 md:w-32 lg:group-hover:scale-125">
        <img src="{{ asset('storage/' . $club->escudo) }}" alt="Escudo {{ $club->nombre }}" class="h-full w-full object-contain">
      </figure>

      <h2 class="font-(--fuente-tercearia) text-[1.3rem] text-(--color-letras-primario) md:text-[1.6rem]">{{ $club->nombre }}</h2>

    </article>

  </a>
  @endforeach

</section>


@endsection