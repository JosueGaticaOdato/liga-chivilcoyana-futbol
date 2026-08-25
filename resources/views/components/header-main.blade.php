@props(['title', 'subtitle' => null, 'image' => null, 'imageAlt' => ''])

<header
  class="
        relative
        flex h-64 flex-col
        items-center justify-center {{ $image ? '' : 'lg:items-start' }}
        gap-0
        overflow-hidden
        bg-[linear-gradient(90deg,var(--color-degradado-1),var(--color-degradado-2))]
        p-16
        mb-8
        text-center
    ">
  <!-- Background Image Layer -->
  <div
    class="absolute inset-0 z-0 bg-cover bg-center mix-blend-overlay"
    style="background-image: url('{{ asset('images/bg1.png') }}');"></div>

  <!-- Gradient Overlay Layer -->
  <div
    class="absolute inset-0 z-1 bg-[linear-gradient(to_right,color-mix(in_srgb,var(--color-degradado-1)_90%,transparent)_0%,color-mix(in_srgb,var(--color-degradado-2)_60%,transparent)_50%,transparent_100%)]"></div>

  @if ($image)
  <figure class="relative z-10 w-20 h-20">
    <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-full object-contain">
  </figure>
  @endif

  <h1
    class="
            relative z-2
            pb-2
            {{ $image ? 'text-[1.5rem] md:text-[2.5rem]' : 'text-[2.5rem] md:text-[3.5rem]' }}
            font-bold
            tracking-[-0.025em]
            text-(--color-letras-secundario)
            filter-(--sombra-header)
            [font-family:var(--fuente-primaria)]
        ">
    {{ $title }}
  </h1>

  @if ($subtitle)
  <p
    class="
                relative z-2
                text-[1.5rem] md:text-[2.5rem]
                font-bold
                tracking-[-0.025em]
                text-(--color-letras-secundario)
                filter-(--sombra-header)
            ">
    {{ $subtitle }}
  </p>
  @endif

  {{ $slot }}
</header>