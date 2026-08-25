@extends('layouts.app')

@section('title', 'Torneos')

@section('content')

<x-header-main title="Torneos" />

<section class="mx-4 lg:mx-40">

  {{-- <h2>Competiciones disponibles</h2>
    <p>Explora todas las divisiones y copas de la temporada</p> --}}

  <!-- TO-DO Filtro por categoria -->

  <ul class="flex flex-col gap-6 pb-8">

    @foreach ($torneos as $torneo)

    <li>
      <a
        href="{{ route('torneos.torneo', $torneo->slug) }}"
        class="
                        relative
                        flex
                        flex-col
                        gap-4
                        rounded-xl
                        border-l-8
                        border-b-4
                        border-l-(--color-primario)
                        border-b-transparent
                        bg-(--color-blanco)
                        p-6
                        shadow-(--sombra-ultra-suave)
                        transition-all
                        duration-300

                        lg:hover:-translate-y-1
                        lg:hover:border-b-(--color-primario)
                        lg:hover:shadow-(--sombra-suave)
                    ">

        <article class="flex w-full items-start gap-4">

          {{-- ICONO --}}
          <span
            class="
                    flex
                    h-16
                    w-16
                    shrink-0
                    items-center
                    justify-center
                    rounded-full
                    bg-linear-to-br
                    from-(--color-degradado-1)
                    to-(--color-degradado-2)
                    text-(--color-blanco)
                ">
            <ion-icon
              name="trophy-outline"
              class="text-[2rem]"></ion-icon>
          </span>

          {{-- DETALLES --}}
          <section class="flex flex-col items-start">

            {{-- ESTADO --}}
            <span
              class="
                                    mb-1
                                    inline-flex
                                    rounded-full
                                    px-2.5
                                    py-0.5
                                    text-xs
                                    font-semibold

                                    {{ $torneo->estado === 'en_curso'
                                        ? 'bg-(--color-success) text-(--color-blanco)'
                                        : 'bg-(--color-error) text-(--color-blanco)'
                                    }}
                                ">
              {{ $torneo->estado == 'en_curso' ? 'En Curso' : 'Finalizado' }}
            </span>


            {{-- TÍTULO --}}
            <h3
              class="
                                    pb-1
                                    text-[1.15rem]
                                    font-bold
                                    leading-[1.4rem]
                                    text-(--color-letras-primario)

                                    md:text-xl
                                ">
              {{ $torneo->nombre }} {{ $torneo->temporada->nombre }}
            </h3>


            {{-- CATEGORÍA --}}
            <p
              class="
                                    text-base
                                    text-(--color-letras-primario)

                                    md:text-[1.1rem]
                                ">
              Categoria: {{ $torneo->categoria->nombre }}
            </p>

          </section>

        </article>

      </a>
    </li>

    @endforeach

  </ul>

</section>

@endsection