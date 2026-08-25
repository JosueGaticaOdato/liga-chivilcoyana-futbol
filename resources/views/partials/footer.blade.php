<footer
  class="
        grid
        grid-cols-1
        gap-12
        bg-(--color-footer)
        px-6
        py-8
        pb-4
        text-center
        font-(--fuente-secundaria)
        text-(--color-letras-secundario)

        lg:grid-cols-[3fr_1fr_1fr]
        lg:p-12
        lg:text-left
    ">

  {{-- BRAND --}}
  <section
    class="
            flex
            flex-col
            items-center
            justify-center

            lg:items-start
            lg:justify-start
        ">

    <img
      class="
                mb-4
                h-auto
                max-h-32
                w-auto
            "
      src="{{ asset('images/logo.png') }}"
      alt="Logo Liga Chivilcoyana de Fútbol">

    <p class="mb-4">
      Liga Chivilcoyana de Futbol
    </p>


    {{-- REDES SOCIALES --}}
    <ul
      class="
                flex
                justify-center
                gap-4

                lg:justify-start
            ">

      <li>
        <a
          href="#"
          class="
                        flex
                        h-10
                        w-10
                        items-center
                        justify-center
                        rounded-full
                        bg-(--color-primario)
                        text-(--color-blanco)
                        transition-all
                        duration-300

                        hover:-translate-y-1
                        hover:scale-105
                        hover:bg-(--color-secundario)
                        hover:shadow-[0_8px_20px_rgba(0,0,0,0.25)]
                    ">
          F
        </a>
      </li>

      <li>
        <a
          href="#"
          class="
                        flex
                        h-10
                        w-10
                        items-center
                        justify-center
                        rounded-full
                        bg-(--color-primario)
                        text-(--color-blanco)
                        transition-all
                        duration-300

                        hover:-translate-y-1
                        hover:scale-105
                        hover:bg-(--color-secundario)
                        hover:shadow-[0_8px_20px_rgba(0,0,0,0.25)]
                    ">
          T
        </a>
      </li>

      <li>
        <a
          href="#"
          class="
                        flex
                        h-10
                        w-10
                        items-center
                        justify-center
                        rounded-full
                        bg-(--color-primario)
                        text-(--color-blanco)
                        transition-all
                        duration-300

                        hover:-translate-y-1
                        hover:scale-105
                        hover:bg-(--color-secundario)
                        hover:shadow-[0_8px_20px_rgba(0,0,0,0.25)]
                    ">
          in
        </a>
      </li>

    </ul>

  </section>


  {{-- NAVEGACIÓN --}}
  <nav
    aria-label="Navegación del sitio">

    <h2
      class="
                mb-4
                border-b
                border-(--color-blanco)
                pb-3
                text-center
                text-[1.2rem]
                font-extrabold

                lg:text-left
            ">
      Navegación
    </h2>

    <ul
      class="
                flex
                flex-col
                items-center
                gap-4

                lg:items-start
                lg:pl-1
            ">

      <li class="text-base">
        <a
          href="{{ route('partidos.index') }}"
          class="text-(--color-letras-secundario)">
          Partidos
        </a>
      </li>

      <li class="text-base">
        <a
          href="{{ route('torneos.index') }}"
          class="text-(--color-letras-secundario)">
          Torneos
        </a>
      </li>

      <li class="text-base">
        <a
          href="{{ route('clubes.index') }}"
          class="text-(--color-letras-secundario)">
          Clubes
        </a>
      </li>

      <li class="text-base">
        <a
          href="{{ route('noticias.index') }}"
          class="text-(--color-letras-secundario)">
          Noticias
        </a>
      </li>

      {{-- <li>
                <a href="{{ route('reglamento') }}">
      Reglamento
      </a>
      </li> --}}

    </ul>

  </nav>


  {{-- CONTACTO --}}
  <address class="not-italic">

    <h2
      class="
                mb-4
                border-b
                border-(--color-blanco)
                pb-3
                text-center
                text-[1.2rem]
                font-extrabold

                lg:text-left
            ">
      Contacto
    </h2>

    <ul
      class="
                flex
                flex-col
                items-center
                gap-4

                lg:items-start
                lg:pl-1
            ">

      <li class="text-base">
        contacto@gmail.com
      </li>

      <li class="text-base">
        +54 11 1111 1111
      </li>

      <li class="text-base">
        Dirección: av asad 123
      </li>

    </ul>

  </address>


  {{-- COPYRIGHT --}}
  <small
    class="
            col-span-full
            border-t
            border-(--color-letras-secundario)
            pt-4
            text-center
            text-[0.8rem]
            text-(--color-letras-secundario)
        ">
    <em class="p-2 font-normal">
      Copyright © 2026 – Liga Chivilcoyana de Fútbol. Todos los derechos reservados.
    </em>
  </small>

</footer>