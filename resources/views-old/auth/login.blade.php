@extends('layouts.app')

@section('title', 'Iniciar sesion')

@push('styles')
    @vite('resources/css/auth/auth.css')
@endpush

@section('content')

    <section class="auth-container">

        <header class="auth-header">
            <ion-icon name="football-outline" class="auth-icon"></ion-icon>
            <h1>Iniciar sesión</h1>
            <p>Accedé a tu de la Liga Chivilcoyana</p>
        </header>

        <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
            @csrf

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="cuenta@correo.com" required autofocus>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">
                Entrar al sistema
            </button>
        </form>

        <footer class="auth-footer">
            <p>¿Aún no tienes una cuenta?
                <a href="{{ route('register') }}">Registrate aquí</a>
            </p>
        </footer>


    </section>
@endsection
