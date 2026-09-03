@if (session('success'))
  <div id="alert-success" class="mb-6 flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50/90 p-4 text-emerald-800 shadow-sm transition-all duration-300">
    <div class="flex items-center gap-3">
      <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500 text-white shadow-sm">
        <ion-icon name="checkmark-circle" class="text-xl"></ion-icon>
      </div>
      <div>
        <p class="font-semibold text-sm text-emerald-900">¡Operación exitosa!</p>
        <p class="text-xs text-emerald-700">{{ session('success') }}</p>
      </div>
    </div>
    <button type="button" onclick="document.getElementById('alert-success').remove()" class="rounded-lg p-1 text-emerald-600 hover:bg-emerald-100 hover:text-emerald-900 transition-colors">
      <ion-icon name="close-outline" class="text-lg"></ion-icon>
    </button>
  </div>
@endif

@if (session('error'))
  <div id="alert-error" class="mb-6 flex items-center justify-between rounded-xl border border-rose-200 bg-rose-50/90 p-4 text-rose-800 shadow-sm transition-all duration-300">
    <div class="flex items-center gap-3">
      <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-rose-500 text-white shadow-sm">
        <ion-icon name="alert-circle" class="text-xl"></ion-icon>
      </div>
      <div>
        <p class="font-semibold text-sm text-rose-900">Ocurrió un inconveniente</p>
        <p class="text-xs text-rose-700">{{ session('error') }}</p>
      </div>
    </div>
    <button type="button" onclick="document.getElementById('alert-error').remove()" class="rounded-lg p-1 text-rose-600 hover:bg-rose-100 hover:text-rose-900 transition-colors">
      <ion-icon name="close-outline" class="text-lg"></ion-icon>
    </button>
  </div>
@endif

@if ($errors->any())
  <div id="alert-errors" class="mb-6 rounded-xl border border-amber-200 bg-amber-50/90 p-4 text-amber-900 shadow-sm transition-all duration-300">
    <div class="flex items-center justify-between mb-2">
      <div class="flex items-center gap-2">
        <ion-icon name="warning-outline" class="text-xl text-amber-600"></ion-icon>
        <p class="font-semibold text-sm text-amber-900">Por favor corrige los siguientes campos:</p>
      </div>
      <button type="button" onclick="document.getElementById('alert-errors').remove()" class="rounded-lg p-1 text-amber-600 hover:bg-amber-100 transition-colors">
        <ion-icon name="close-outline" class="text-lg"></ion-icon>
      </button>
    </div>
    <ul class="list-disc pl-6 text-xs text-amber-800 space-y-1">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
