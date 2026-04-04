        <div
            class="max-w-[1440px] mx-auto flex flex-col md:flex-row min-h-screen"
        >
            <aside
                class="w-full md:w-64 bg-white dark:bg-surface-dark border-r border-gray-200 dark:border-gray-800 flex flex-col"
            >
                <nav class="p-6 space-y-1">
                    <p
                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 px-4"
                    >
                        Menú Principal
                    </p>
                    <a
                        class="sidebar-link-active flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition shadow-md shadow-primary/20"
                        href="#"
                    >
                        <span class="material-symbols-outlined">dashboard</span>
                        Escritorio
                    </a>
                    <a
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition"
                        href="#"
                    >
                        <span class="material-symbols-outlined"
                            >emoji_events</span
                        >
                        Torneos
                    </a>
                    <a
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition"
                        href="#"
                    >
                        <span class="material-symbols-outlined"
                            >sports_soccer</span
                        >
                        Partidos
                    </a>
                    <a
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition"
                        href="#"
                    >
                        <span class="material-symbols-outlined">groups</span>
                        Equipos
                    </a>
                    <a
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition"
                        href="#"
                    >
                        <span class="material-symbols-outlined">newspaper</span>
                        Noticias
                    </a>
                    <div class="pt-8 px-4">
                        <p
                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4"
                        >
                            Configuración
                        </p>
                        <button
                            class="w-full flex items-center gap-3 py-3 text-sm font-medium text-gray-500 hover:text-primary transition"
                            onclick="
                                document.documentElement.classList.toggle(
                                    'dark',
                                )
                            "
                        >
                            <span class="material-symbols-outlined"
                                >brightness_medium</span
                            >
                            Modo Oscuro
                        </button>
                        <a
                            class="flex items-center gap-3 py-3 text-sm font-medium text-gray-500 hover:text-primary transition"
                            href="#"
                        >
                            <span class="material-symbols-outlined"
                                >settings</span
                            >
                            Ajustes
                        </a>
                    </div>
                </nav>
            </aside>
            <main class="flex-grow p-6 lg:p-10 main-content-height">
                <header
                    class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4"
                >
                    <div>
                        <h1
                            class="text-3xl font-black text-gray-900 dark:text-white"
                        >
                            Escritorio Administrativo
                        </h1>
                        <p
                            class="text-sm text-gray-500 dark:text-gray-400 mt-1"
                        >
                            Bienvenido al centro de gestión del fútbol local.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <button
                            class="bg-white dark:bg-surface-dark border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 dark:hover:bg-gray-800 transition shadow-sm"
                        >
                            <span class="material-symbols-outlined text-sm"
                                >download</span
                            >
                            Descargar Reporte
                        </button>
                        <button
                            class="bg-primary hover:bg-primaryDark text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-lg shadow-primary/25 transition"
                        >
                            <span class="material-symbols-outlined text-sm"
                                >add</span
                            >
                            Nuevo Torneo
                        </button>
                    </div>
                </header>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10"
                >
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-4 hover:border-primary/30 transition-colors"
                    >
                        <div
                            class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 text-primary rounded-2xl flex items-center justify-center"
                        >
                            <span class="material-symbols-outlined text-3xl"
                                >emoji_events</span
                            >
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest"
                            >
                                Torneos Activos
                            </p>
                            <h3 class="text-3xl font-black">12</h3>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-4 hover:border-green-500/30 transition-colors"
                    >
                        <div
                            class="w-14 h-14 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-2xl flex items-center justify-center"
                        >
                            <span class="material-symbols-outlined text-3xl"
                                >stadium</span
                            >
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest"
                            >
                                Partidos Hoy
                            </p>
                            <h3 class="text-3xl font-black">8</h3>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-4 hover:border-orange-500/30 transition-colors"
                    >
                        <div
                            class="w-14 h-14 bg-orange-100 dark:bg-orange-900/30 text-orange-600 rounded-2xl flex items-center justify-center"
                        >
                            <span class="material-symbols-outlined text-3xl"
                                >groups</span
                            >
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest"
                            >
                                Equipos Inscritos
                            </p>
                            <h3 class="text-3xl font-black">48</h3>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center gap-4 hover:border-purple-500/30 transition-colors"
                    >
                        <div
                            class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-2xl flex items-center justify-center"
                        >
                            <span class="material-symbols-outlined text-3xl"
                                >visibility</span
                            >
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest"
                            >
                                Visitas Web
                            </p>
                            <h3 class="text-3xl font-black">2.4k</h3>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                        >
                            <div
                                class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/30 dark:bg-gray-800/20"
                            >
                                <div class="flex items-center gap-3">
                                    <span
                                        class="material-symbols-outlined text-primary"
                                        >edit_calendar</span
                                    >
                                    <h2
                                        class="font-black text-gray-800 dark:text-white uppercase tracking-tight"
                                    >
                                        Gestión de Torneos
                                    </h2>
                                </div>
                                <button
                                    class="text-xs font-bold text-primary hover:underline"
                                >
                                    Ver todos los torneos
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead
                                        class="text-[10px] text-gray-400 uppercase bg-gray-50/50 dark:bg-gray-800/50"
                                    >
                                        <tr>
                                            <th class="px-6 py-4 font-black">
                                                Torneo
                                            </th>
                                            <th class="px-6 py-4 font-black">
                                                Estado
                                            </th>
                                            <th class="px-6 py-4 font-black">
                                                Equipos
                                            </th>
                                            <th
                                                class="px-6 py-4 text-right font-black"
                                            >
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-100 dark:divide-gray-800"
                                    >
                                        <tr
                                            class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition"
                                        >
                                            <td class="px-6 py-4">
                                                <p
                                                    class="font-bold text-gray-900 dark:text-white"
                                                >
                                                    Copa Primera 2025
                                                </p>
                                                <p
                                                    class="text-[10px] text-gray-400"
                                                >
                                                    Categoría Libre
                                                </p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-[10px] font-black uppercase"
                                                    >En curso</span
                                                >
                                            </td>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-500"
                                            >
                                                20
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div
                                                    class="flex justify-end gap-1"
                                                >
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary hover:bg-primary/10 rounded-lg transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >edit</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >delete</span
                                                        >
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr
                                            class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition"
                                        >
                                            <td class="px-6 py-4">
                                                <p
                                                    class="font-bold text-gray-900 dark:text-white"
                                                >
                                                    Torneo Clausura B
                                                </p>
                                                <p
                                                    class="text-[10px] text-gray-400"
                                                >
                                                    Segunda División
                                                </p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-[10px] font-black uppercase"
                                                    >Inscripción</span
                                                >
                                            </td>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-500"
                                            >
                                                14
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div
                                                    class="flex justify-end gap-1"
                                                >
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary hover:bg-primary/10 rounded-lg transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >edit</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >delete</span
                                                        >
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                        >
                            <div
                                class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/30 dark:bg-gray-800/20"
                            >
                                <div class="flex items-center gap-3">
                                    <span
                                        class="material-symbols-outlined text-primary"
                                        >article</span
                                    >
                                    <h2
                                        class="font-black text-gray-800 dark:text-white uppercase tracking-tight"
                                    >
                                        Noticias Recientes
                                    </h2>
                                </div>
                                <button
                                    class="bg-primary/10 text-primary px-4 py-1.5 rounded-xl text-xs font-bold hover:bg-primary/20 transition flex items-center gap-2"
                                >
                                    <span
                                        class="material-symbols-outlined text-sm"
                                        >add</span
                                    >
                                    Crear Noticia
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead
                                        class="text-[10px] text-gray-400 uppercase bg-gray-50/50 dark:bg-gray-800/50"
                                    >
                                        <tr>
                                            <th class="px-6 py-4 font-black">
                                                Título
                                            </th>
                                            <th class="px-6 py-4 font-black">
                                                Fecha de Publicación
                                            </th>
                                            <th
                                                class="px-6 py-4 text-right font-black"
                                            >
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-100 dark:divide-gray-800"
                                    >
                                        <tr
                                            class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition"
                                        >
                                            <td class="px-6 py-4">
                                                <span
                                                    class="font-medium text-gray-900 dark:text-white truncate max-w-xs block"
                                                    >Atlético Central se
                                                    consolida como único
                                                    líder</span
                                                >
                                            </td>
                                            <td
                                                class="px-6 py-4 text-gray-500 text-xs"
                                            >
                                                24 May, 2025
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div
                                                    class="flex justify-end gap-1"
                                                >
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >visibility</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >edit</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-red-500 transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >delete</span
                                                        >
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr
                                            class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition"
                                        >
                                            <td class="px-6 py-4">
                                                <span
                                                    class="font-medium text-gray-900 dark:text-white truncate max-w-xs block"
                                                    >Mejoras en el Estadio
                                                    Municipal anunciadas</span
                                                >
                                            </td>
                                            <td
                                                class="px-6 py-4 text-gray-500 text-xs"
                                            >
                                                22 May, 2025
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div
                                                    class="flex justify-end gap-1"
                                                >
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >visibility</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-primary transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >edit</span
                                                        >
                                                    </button>
                                                    <button
                                                        class="p-2 text-gray-400 hover:text-red-500 transition"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-lg"
                                                            >delete</span
                                                        >
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-1">
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 h-full"
                        >
                            <div
                                class="p-6 border-b border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-gray-50/30 dark:bg-gray-800/20"
                            >
                                <span
                                    class="material-symbols-outlined text-primary"
                                    >history</span
                                >
                                <h2
                                    class="font-black text-gray-800 dark:text-white uppercase tracking-tight"
                                >
                                    Acciones Recientes
                                </h2>
                            </div>
                            <div class="p-8 space-y-8">
                                <div
                                    class="flex gap-4 relative before:absolute before:left-4 before:top-10 before:bottom-[-20px] before:w-px before:bg-gray-100 dark:before:bg-gray-800 last:before:hidden"
                                >
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center flex-shrink-0 z-10 border border-blue-100 dark:border-blue-800"
                                    >
                                        <span
                                            class="material-symbols-outlined text-primary text-sm"
                                            >edit</span
                                        >
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold text-gray-900 dark:text-white"
                                        >
                                            Resultado actualizado
                                        </p>
                                        <p class="text-[11px] text-gray-500">
                                            Atl. Central vs Dep. Norte (2 - 1)
                                        </p>
                                        <p
                                            class="text-[10px] text-primary font-bold mt-1 uppercase tracking-wider"
                                        >
                                            Hace 5 minutos
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex gap-4 relative before:absolute before:left-4 before:top-10 before:bottom-[-20px] before:w-px before:bg-gray-100 dark:before:bg-gray-800 last:before:hidden"
                                >
                                    <div
                                        class="w-8 h-8 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center flex-shrink-0 z-10 border border-green-100 dark:border-green-800"
                                    >
                                        <span
                                            class="material-symbols-outlined text-green-500 text-sm"
                                            >add</span
                                        >
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold text-gray-900 dark:text-white"
                                        >
                                            Nueva noticia publicada
                                        </p>
                                        <p class="text-[11px] text-gray-500">
                                            "Inscripciones abiertas..."
                                        </p>
                                        <p
                                            class="text-[10px] text-primary font-bold mt-1 uppercase tracking-wider"
                                        >
                                            Hace 2 horas
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex gap-4 relative before:absolute before:left-4 before:top-10 before:bottom-[-20px] before:w-px before:bg-gray-100 dark:before:bg-gray-800 last:before:hidden"
                                >
                                    <div
                                        class="w-8 h-8 rounded-full bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center flex-shrink-0 z-10 border border-orange-100 dark:border-orange-800"
                                    >
                                        <span
                                            class="material-symbols-outlined text-orange-500 text-sm"
                                            >group_add</span
                                        >
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold text-gray-900 dark:text-white"
                                        >
                                            Nuevo equipo registrado
                                        </p>
                                        <p class="text-[11px] text-gray-500">
                                            Deportivo Sur se unió a 2da División
                                        </p>
                                        <p
                                            class="text-[10px] text-primary font-bold mt-1 uppercase tracking-wider"
                                        >
                                            Hoy, 10:15 AM
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div
                                        class="w-8 h-8 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center flex-shrink-0 z-10 border border-red-100 dark:border-red-800"
                                    >
                                        <span
                                            class="material-symbols-outlined text-red-500 text-sm"
                                            >delete</span
                                        >
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold text-gray-900 dark:text-white"
                                        >
                                            Torneo Eliminado
                                        </p>
                                        <p class="text-[11px] text-gray-500">
                                            Torneo Amistoso Verano (Borrador)
                                        </p>
                                        <p
                                            class="text-[10px] text-primary font-bold mt-1 uppercase tracking-wider"
                                        >
                                            Ayer, 18:40 PM
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

