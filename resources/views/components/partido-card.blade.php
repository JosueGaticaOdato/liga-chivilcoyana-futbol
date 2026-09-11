<article class="w-full max-w-120 p-6 bg-(--color-blanco) rounded-2xl font-(--fuente-primaria) shadow-(--sombra-suave) transition-transform duration-300 ease-in-out lg:hover:-translate-y-1">
    <a href="{{ route('partidos.show', $partido) }}" class="flex flex-col gap-6">

        <header class="flex justify-between items-center">
            <time datetime="{{ $partido->fecha_hora->format('Y-m-d H:i') }}" class="text-[0.85rem] font-black text-(--color-letras-terceario) uppercase tracking-[0.02rem]">
                {{ $partido->fecha_hora->translatedFormat('l j \d\e F - H:i') }}
            </time>

            @if ($partido->estado === 'en_vivo')
            <span class="inline-flex items-center gap-1.5 text-xs font-bold rounded text-(--color-letras-secundario) px-3 uppercase py-1 bg-(--color-error)">
                <span class="h-1.5 w-1.5 rounded-full bg-(--color-blanco) animate-ping"></span>
                En Vivo
            </span>
            
            @else
            <span class="text-xs font-bold py-1 px-3 rounded uppercase text-(--color-letras-secundario) {{ match($partido->estado) {
                'programado' => 'bg-(--color-stay)',
                'finalizado' => 'bg-(--color-primario)',
                default => ''
            } }}">
                {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
            </span>

            @endif
            
        </header>

        <main class="flex justify-between items-center">

            <article class="flex flex-col items-center gap-3 flex-1">
                <figure class="w-15 h-17.5">
                    <img class="w-full h-full object-contain" src="{{ asset('storage/' . $partido->local->club->escudo) }}" alt="Escudo {{ $partido->local->nombre }}">
                </figure>

                <h3 class="m-0 text-[0.9rem] font-bold text-(--color-letras-primario) text-center">
                    {{ $partido->local->nombre ?? $partido->local->club->nombre ?? 'Local' }}
                </h3>
            </article>

            <span class="text-2xl font-extrabold {{ $partido->estado === 'en_vivo' ? 'text-red-500' : 'text-(--color-letras-cuaternario)' }} mx-4">
                @if ($partido->estado === 'programado')
                    <span>VS</span>
                @else
                    <span>{{ $partido->goles_local ?? 0 }}</span>
                    -
                    <span>{{ $partido->goles_visitante ?? 0 }}</span>
                @endif
            </span>

            <article class="flex flex-col items-center gap-3 flex-1">
                <figure class="w-15 h-17.5">
                    <img class="w-full h-full object-contain" src="{{ asset('storage/' . $partido->visitante->club->escudo) }}" alt="Escudo {{ $partido->visitante->nombre }}">
                </figure>

                <h3 class="m-0 text-[0.9rem] font-bold text-(--color-letras-primario) text-center">
                    {{ $partido->visitante->nombre ?? $partido->visitante->club->nombre ?? 'Visitante' }}
                </h3>
            </article>

        </main>

        <footer class="text-center flex justify-center items-center flex-col gap-[0.2rem]">
            <h4 class="text-[0.8rem] font-semibold text-(--color-letras-cuaternario) uppercase tracking-[0.05rem]">
                {{ $partido->estadio->nombre ?? 'Estadio: A definir' }}
            </h4>

            <p class="text-[0.7rem] font-semibold text-(--color-letras-cuaternario) uppercase tracking-[0.05rem]">
                Torneo {{ $partido->torneo->nombre }} {{ $partido->torneo->temporada->nombre }}- Fecha {{ $partido->jornada}}
            </p>
        </footer>

    </a>
</article>