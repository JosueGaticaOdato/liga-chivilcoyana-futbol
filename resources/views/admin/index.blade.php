@extends('layouts.admin')

@section('title', 'Liga Chivilcoyana de Futbol')

@push('styles')
    @vite('resources/css/admin/index.css')
@endpush

@section('content')

    <section class="stats">
        <article class="stat-card">
            <div class="stat-icon">
                <span class="material-symbols-outlined">emoji_events</span>
            </div>
            <div>
                <p class="stat-label">Torneos Activos</p>
                <h3>12</h3>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-icon success">
                <span class="material-symbols-outlined">stadium</span>
            </div>
            <div>
                <p class="stat-label">Partidos Hoy</p>
                <h3>8</h3>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-icon warning">
                <span class="material-symbols-outlined">groups</span>
            </div>
            <div>
                <p class="stat-label">Partidos en Juego</p>
                <h3>48</h3>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-icon purple">
                <span class="material-symbols-outlined">visibility</span>
            </div>
            <div>
                <p class="stat-label">Visitas Web</p>
                <h3>2.4k</h3>
            </div>
        </article>
    </section>

    <!-- MAIN GRID -->
    <section class="dashboard-grid">

        <!-- LEFT -->
        <section class="dashboard-main">

            <!-- TORNEOS -->
            <article class="card">
                <header class="card-header">
                    <h2>
                        <span class="material-symbols-outlined">edit_calendar</span>
                        Gestión de Torneos
                    </h2>
                    <button class="link">Ver todos</button>
                </header>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Torneo</th>
                                <th>Estado</th>
                                <th>Equipos</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bold">Copa Primera 2025</td>
                                <td><span class="badge success">En curso</span></td>
                                <td>20</td>
                                <td class="text-right actions">
                                    <button>edit</button>
                                    <button>delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <!-- NOTICIAS -->
            <article class="card">
                <header class="card-header">
                    <h2>
                        <span class="material-symbols-outlined">article</span>
                        Noticias Recientes
                    </h2>

                    <button class="btn btn-light">
                        <span class="material-symbols-outlined">add</span>
                        Crear Noticia
                    </button>
                </header>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Fecha</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Atlético Central se consolida...</td>
                                <td>24 May, 2025</td>
                                <td class="text-right actions">
                                    <button>visibility</button>
                                    <button>edit</button>
                                    <button>delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

        </section>

        <!-- RIGHT -->
        <aside class="dashboard-sidebar">
            <article class="card">
                <header class="card-header simple">
                    <h2>
                        <span class="material-symbols-outlined">history</span>
                        Acciones Recientes
                    </h2>
                </header>

                <div class="timeline">

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                        <div>
                            <p class="bold">Resultado actualizado</p>
                            <p class="muted">Atl. Central vs Dep. Norte</p>
                            <span class="time">Hace 5 minutos</span>
                        </div>
                    </div>

                </div>
            </article>
        </aside>

    </section>

@endsection
