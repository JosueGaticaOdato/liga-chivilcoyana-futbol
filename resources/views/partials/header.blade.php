<header class="header">
    <h1 class="header-titulo"><a href="{{ route('inicio') }}"><img class="header-logo" src="{{ asset('images/logo.png') }}"
                alt="Logo Liga Chivilcoyana de Futbol"></a></h1>

    <nav class="header-navegacion">
        <ul>
            <li><a href="{{ route('partido') }}">Partidos</a></li>
            <li><a href="{{ route('torneos.index') }}">Torneos</a></li>
            <li><a href="{{ route('equipos.index') }}">Equipos</a></li>
            <li><a href="{{ route('noticias') }}">Noticias</a></li>
        </ul>
    </nav>

    <a class="header-login" href="{{ route('inicio') }}">Iniciar sesion</a>
</header>
