<header class="header">
    <h1 class="header-titulo"><a href="{{ route('home') }}"><img class="header-logo" src="{{ asset('images/logo.png') }}"
                alt="Logo Liga Chivilcoyana de Futbol"></a></h1>

    <nav class="header-navegacion">
        <ul>
            <li>
                <a href="{{ route('partidos.index') }}" class="{{ request()->routeIs('partidos') ? 'active' : '' }}">Partidos</a>
            </li>
            <li>
                <a href="{{ route('torneos.index') }}" class="{{ request()->routeIs('torneos.*') ? 'active' : '' }}">Torneos</a>
            </li>
            <li>
                <a href="{{ route('equipos.index') }}" class="{{ request()->routeIs('equipos.*') ? 'active' : '' }}">Equipos</a>
            </li>
            <li>
                <a href="{{ route('noticias.index') }}" class="{{ request()->routeIs('noticias.*') ? 'active' : '' }}">Noticias</a>
            </li>
        </ul>
    </nav>

    <a class="header-login" href="{{ route('home') }}">Iniciar sesion</a>
</header>
