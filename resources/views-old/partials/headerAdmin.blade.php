<header class="header">
    <div class="header-title">
        <a href="{{ route('home') }}"><img class="header-logo" src="{{ asset('images/logo.png') }}"
            alt="Logo Liga Chivilcoyana de Futbol">
        </a>
        <div class="header-text">
            <h1>Liga Chivilcoyana de Futbol</h1>
            <p>Panel de Administracion</p>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="avatar">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmmwZ1mQ2xSEz_YPien4jWmDBa85B4XEgMC4-CxPue9qF7xhLQMOtxKsHKqJKcknzsxNJduUAdWajE3aRD218y8DHDcKPmw6BpzTGAXUVCnsUfw54L3IYDvi8NsNZbPVW-cKFF_VAoBibGjoeADTyydhzUMEEqKtPNAOI7DO8dyEU45n12xlcVoFSE0-zXqk_5BU4fx3Z4j-R6OLA0i_gxS2a4FhPHikT2lLXYgP7VRL1wsF9zKIVuc25dbxhOF9xiUfuiCgJbgOp3" alt="Avatar">
            </div>

            <div class="user-text">
                <p class="user-name">Admin Local</p>
                <p class="logout">Cerrar Sesión</p>
            </div>

            <span class="material-symbols-outlined logout-icon">logout</span>
        </div>
    </div>

    {{-- <!-- LOGIN DESKTOP -->
    @auth
        <a class="header-login" href="{{ route('perfil') }}" id="login">Mi Perfil</a>
    @else
        <a class="header-login" href="{{ route('login') }}" id="login">Iniciar sesion</a>
    @endauth --}}
</header>
