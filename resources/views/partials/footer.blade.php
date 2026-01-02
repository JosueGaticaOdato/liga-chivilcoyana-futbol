<footer class="footer">

    <section class="footer-brand">
        <img class="footer-logo" src="{{ asset('images/logo.png') }}" alt="Logo Liga Chivilcoyana de Fútbol">

        <p class="footer-description">
            Liga Chivilcoyana de Futbol
        </p>

        <ul class="footer-social">
            <li><a href="#">F</a></li>
            <li><a href="#">T</a></li>
            <li><a href="#">in</a></li>
        </ul>
    </section>

    <nav class="footer-nav" aria-label="Navegación del sitio">
        <h2>Navegación</h2>
        <ul>
            <li><a href="{{ route('partido') }}">Partidos</a></li>
            <li><a href="{{ route('tablas') }}">Tablas</a></li>
            <li><a href="{{ route('equipos') }}">Equipos</a></li>
            <li><a href="{{ route('noticias') }}">Noticias</a></li>
            <li><a href="{{ route('reglamento') }}">Reglamento</a></li>
        </ul>
    </nav>

    <address class="footer-contact">
        <h2>Contacto</h2>
        <ul>
            <li>contacto@gmail.com</li>
            <li>+54 11 1111 1111</li>
            <li>Dirección: av asad 123</li>
        </ul>
    </address>

    <small class="footer-copy">
        <em>Copyright © 2025 – Liga Chivilcoyana de Fútbol. Todos los derechos reservados.</em>
    </small>
</footer>
