<header class="header">
    <h1 class="header-titulo"><a href="{{ route('home') }}"><img class="header-logo" src="{{ asset('images/logo.png') }}"
                alt="Logo Liga Chivilcoyana de Futbol"></a></h1>

    <!-- BOTON HAMBURGUESA -->
    <button class="header-hamburguesa" id="btnMenu">
        ☰
    </button>

    <nav class="header-navegacion" id="menu">
        <ul>
            <li>
                <a href="{{ route('partidos.index') }}"
                    class="{{ request()->routeIs('partidos') ? 'active' : '' }}">Partidos</a>
            </li>
            <li>
                <a href="{{ route('torneos.index') }}"
                    class="{{ request()->routeIs('torneos.*') ? 'active' : '' }}">Torneos</a>
            </li>
            <li>
                <a href="{{ route('equipos.index') }}"
                    class="{{ request()->routeIs('equipos.*') ? 'active' : '' }}">Equipos</a>
            </li>
            <li>
                <a href="{{ route('noticias.index') }}"
                    class="{{ request()->routeIs('noticias.*') ? 'active' : '' }}">Noticias</a>
            </li>

            <!-- LOGIN MOBILE -->
            <li class="nav-login">
                @auth
                    <a class="login" href="{{ route('perfil') }}">Mi Perfil</a>
                @else
                    <a class="login" href="{{ route('login') }}">Iniciar sesión</a>
                @endauth
            </li>
        </ul>
    </nav>

    <!-- LOGIN DESKTOP -->
    @auth
        <a class="header-login" href="{{ route('perfil') }}" id="login">Mi Perfil</a>
    @else
        <a class="header-login" href="{{ route('login') }}" id="login">Iniciar sesion</a>
    @endauth
</header>
