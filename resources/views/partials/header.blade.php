<header
    class="
        fixed
        top-0
        left-0
        z-50
        flex
        h-28
        w-full
        items-center
        justify-between
        bg-(--color-header)
        font-(--fuente-primaria)
        lg:justify-around
    "
>
    {{-- LOGO --}}
    <h1 class="flex h-full items-center justify-center">

        <a
            href="{{ route('home') }}"
            class="flex h-full items-center px-4"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Liga Chivilcoyana de Futbol"
                class="
                    h-20
                    w-auto
                    transition-all
                    duration-350

                    lg:hover:scale-110
                "
            >
        </a>

    </h1>


    {{-- BOTÓN HAMBURGUESA --}}
    <button
        class="
            z-3
            mr-6
            cursor-pointer
            text-[2.5rem]
            text-(--color-negro)

            lg:hidden
        "
        id="btnMenu"
        type="button"
        aria-label="Abrir menú"
    >
        ☰
    </button>


    {{-- NAVEGACIÓN --}}
    <nav
        id="menu"
        class="
            absolute
            left-0
            top-28
            hidden
            w-full
            bg-(--color-header)

            [&.active]:z-5
            [&.active]:block

            lg:static
            lg:flex
            lg:w-[40%]
            lg:justify-center
        "
    >

        <ul
            class="
                flex
                flex-col
                items-center
                gap-4
                py-6

                lg:flex-row
                lg:justify-around
                lg:items-center
                lg:gap-8
            "
        >

            {{-- PARTIDOS --}}
            <li
                class="
                    text-[1.1rem]
                    font-bold
                    uppercase

                    lg:transition-all
                    lg:duration-350
                    lg:hover:scale-125
                    lg:hover:text-(--color-primario)
                    lg:hover:border-b-[3px]
                    lg:hover:border-(--color-primario)
                "
            >
                <a
                    href="{{ route('partidos.index') }}"
                    class="
                        {{ request()->routeIs('partidos') ? 'text-(--color-primario) border-b-[3px] border-(--color-primario)' : '' }}
                    "
                >
                    Partidos
                </a>
            </li>


            {{-- TORNEOS --}}
            <li
                class="
                    text-[1.1rem]
                    font-bold
                    uppercase

                    lg:transition-all
                    lg:duration-350
                    lg:hover:scale-125
                    lg:hover:text-(--color-primario)
                    lg:hover:border-b-[3px]
                    lg:hover:border-(--color-primario)
                "
            >
                <a
                    href="{{ route('torneos.index') }}"
                    class="
                        {{ request()->routeIs('torneos.*') ? 'text-(--color-primario) border-b-[3px] border-(--color-primario)' : '' }}
                    "
                >
                    Torneos
                </a>
            </li>


            {{-- CLUBES --}}
            <li
                class="
                    text-[1.1rem]
                    font-bold
                    uppercase

                    lg:transition-all
                    lg:duration-350
                    lg:hover:scale-125
                    lg:hover:text-(--color-primario)
                    lg:hover:border-b-[3px]
                    lg:hover:border-(--color-primario)
                "
            >
                <a
                    href="{{ route('clubes.index') }}"
                    class="
                        {{ request()->routeIs('clubes.*') ? 'text-(--color-primario) border-b-[3px] border-(--color-primario)' : '' }}
                    "
                >
                    Clubes
                </a>
            </li>


            {{-- NOTICIAS --}}
            <li
                class="
                    text-[1.1rem]
                    font-bold
                    uppercase

                    lg:transition-all
                    lg:duration-350
                    lg:hover:scale-125
                    lg:hover:text-(--color-primario)
                    lg:hover:border-b-[3px]
                    lg:hover:border-(--color-primario)
                "
            >
                <a
                    href="{{ route('noticias.index') }}"
                    class="
                        {{ request()->routeIs('noticias.*') ? 'text-(--color-primario) border-b-[3px] border-(--color-primario)' : '' }}
                    "
                >
                    Noticias
                </a>
            </li>


            {{-- LOGIN MOBILE --}}
            <li class="lg:hidden">

                @auth
                    <a
                        class="
                            rounded-lg
                            bg-(--color-primario)
                            p-2
                            font-bold
                            text-(--color-letras-secundario)
                        "
                        href="{{ route('perfil') }}"
                    >
                        Mi Perfil
                    </a>
                @else
                    <a
                        class="
                            rounded-lg
                            bg-(--color-primario)
                            p-2
                            font-bold
                            text-(--color-letras-secundario)
                        "
                        href="{{ route('login') }}"
                    >
                        Iniciar sesión
                    </a>
                @endauth

            </li>

        </ul>

    </nav>


    {{-- LOGIN DESKTOP --}}
    @auth

        <a
            class="
                mr-12
                hidden
                rounded-lg
                border
                border-transparent
                bg-(--color-primario)
                p-2
                font-extrabold
                text-(--color-letras-secundario)

                lg:block
                lg:transition-all
                lg:duration-350
                lg:ease-in-out
                lg:hover:border-(--color-primario)
                lg:hover:bg-(--color-letras-secundario)
                lg:hover:text-(--color-primario)
            "
            href="{{ route('perfil') }}"
            id="login"
        >
            Mi Perfil
        </a>

    @else

        <a
            class="
                mr-12
                hidden
                rounded-lg
                border
                border-transparent
                bg-(--color-primario)
                p-2
                font-extrabold
                text-(--color-letras-secundario)

                lg:block
                lg:transition-all
                lg:duration-350
                lg:ease-in-out
                lg:hover:border-(--color-primario)
                lg:hover:bg-(--color-letras-secundario)
                lg:hover:text-(--color-primario)
            "
            href="{{ route('login') }}"
            id="login"
        >
            Iniciar sesión
        </a>

    @endauth

</header>