<article class="noticia-card">

    <a href="{{ route('noticias.show', $noticia) }}" class="noticia-link">

        @if ($noticia->imagen)
            <figure class="noticia-imagen">
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
            </figure>
        @endif

        <header class="noticia-body">
            <h2 class="noticia-titulo">{{ $noticia->titulo }}</h2>

            <p class="noticia-descripcion">
                {{ $noticia->descripcion }}
            </p>
        </header>

        <footer class="noticia-footer">
            <time datetime="{{ $noticia->fecha_publicacion?->format('Y-m-d') }}">
                {{ $noticia->fecha_publicacion?->format('d M Y') }}
            </time>

            @if ($noticia->autor)
                <span class="autor">{{ $noticia->autor }}</span>
            @endif
        </footer>

    </a>

</article>
