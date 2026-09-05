@extends('admin.layouts.app')

@section('title', 'Editar Club')
@section('page_title', 'Editar Club')

@section('breadcrumbs')
  <span class="text-slate-400">/</span>
  <a href="{{ route('admin.clubes.index') }}" class="hover:text-[#59acda] transition-colors">Clubes</a>
  <span class="text-slate-400">/</span>
  <span class="text-slate-700">Editar</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold text-slate-900">Editar Club: {{ $club->nombre }}</h2>
      <p class="text-xs text-slate-500">Actualiza datos institucionales, estadio o escudo.</p>
    </div>
    <a
      href="{{ route('admin.clubes.index') }}"
      class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
      <ion-icon name="arrow-back-outline"></ion-icon>
      Volver al listado
    </a>
  </div>

  {{-- Form Card --}}
  <div class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-xs">
    <form action="{{ route('admin.clubes.update', $club) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        
        {{-- Nombre Comun --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Nombre Común / Deportivo <span class="text-rose-500">*</span>
          </label>
          <input
            type="text"
            name="nombre"
            value="{{ old('nombre', $club->nombre) }}"
            required
            class="w-full rounded-xl border {{ $errors->has('nombre') ? 'border-rose-400' : 'border-slate-200' }} bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          @error('nombre')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nombre Institucional --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Razón Social / Nombre Oficial <span class="text-rose-500">*</span>
          </label>
          <input
            type="text"
            name="nombre_institucional"
            value="{{ old('nombre_institucional', $club->nombre_institucional) }}"
            required
            class="w-full rounded-xl border {{ $errors->has('nombre_institucional') ? 'border-rose-400' : 'border-slate-200' }} bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
          @error('nombre_institucional')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Estadio Sede --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Estadio Principal
          </label>
          <select
            name="estadio_id"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
            <option value="">Seleccionar estadio (opcional)</option>
            @foreach ($estadios as $estadio)
              <option value="{{ $estadio->id }}" {{ old('estadio_id', $club->estadio_id) == $estadio->id ? 'selected' : '' }}>
                {{ $estadio->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Presidente --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Presidente / Autoridad
          </label>
          <input
            type="text"
            name="presidente"
            value="{{ old('presidente', $club->presidente) }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Fecha Fundacion --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Fecha de Fundación
          </label>
          <input
            type="date"
            name="fecha_fundacion"
            value="{{ old('fecha_fundacion', $club->fecha_fundacion ? $club->fecha_fundacion->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Slug --}}
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Slug / Identificador URL
          </label>
          <input
            type="text"
            name="slug"
            value="{{ old('slug', $club->slug) }}"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">
        </div>

        {{-- Escudo / Logo upload --}}
        <div class="sm:col-span-2">
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Escudo Institucional (Cambiar imagen)
          </label>
          <div class="flex items-center gap-4">
            <div id="preview-container" class="h-20 w-20 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden shrink-0">
              @if ($club->escudo)
                <img id="preview-image" src="{{ asset('storage/' . $club->escudo) }}" alt="{{ $club->nombre }}" class="h-full w-full object-contain">
                <ion-icon name="image-outline" class="text-3xl text-slate-400 hidden" id="preview-icon"></ion-icon>
              @else
                <ion-icon name="image-outline" class="text-3xl text-slate-400" id="preview-icon"></ion-icon>
                <img id="preview-image" src="" alt="Vista previa" class="h-full w-full object-contain hidden">
              @endif
            </div>
            <div class="flex-1">
              <input
                type="file"
                name="escudo"
                id="escudo-input"
                accept="image/*"
                class="w-full text-xs text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#59acda]/10 file:text-[#59acda] hover:file:bg-[#59acda]/20 cursor-pointer">
              <p class="mt-1 text-[11px] text-slate-400">Deja este campo vacío para mantener el escudo actual.</p>
            </div>
          </div>
          @error('escudo')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Descripcion --}}
        <div class="sm:col-span-2">
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
            Reseña Histórica / Descripción
          </label>
          <textarea
            name="descripcion"
            rows="3"
            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#59acda] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#59acda]/20 transition-all">{{ old('descripcion', $club->descripcion) }}</textarea>
        </div>

        {{-- Activo checkbox --}}
        <div class="sm:col-span-2 flex items-center gap-2">
          <input
            type="checkbox"
            name="activo"
            id="activo"
            value="1"
            {{ old('activo', $club->activo) ? 'checked' : '' }}
            class="h-4 w-4 rounded border-slate-300 text-[#59acda] focus:ring-[#59acda]">
          <label for="activo" class="text-sm font-medium text-slate-700 cursor-pointer">
            Club Activo y Afiliado en la Liga
          </label>
        </div>

      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <a
          href="{{ route('admin.clubes.index') }}"
          class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
          Cancelar
        </a>
        <button
          type="submit"
          class="inline-flex items-center gap-2 rounded-xl bg-[#59acda] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#4396c2] transition-colors">
          <ion-icon name="save-outline" class="text-lg"></ion-icon>
          Actualizar Club
        </button>
      </div>

    </form>
  </div>

</div>

@push('scripts')
<script>
  document.getElementById('escudo-input')?.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        const previewImg = document.getElementById('preview-image');
        const previewIcon = document.getElementById('preview-icon');
        previewImg.src = event.target.result;
        previewImg.classList.remove('hidden');
        if (previewIcon) previewIcon.classList.add('hidden');
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endpush
@endsection
