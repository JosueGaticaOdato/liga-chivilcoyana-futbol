@extends('layouts.app')

@section('title', 'Crear cuenta')

@push('styles')
    @vite('resources/css/auth/auth.css')
@endpush

@section('content')
<section class="auth-container">

    <header class="auth-header">
        <ion-icon name="person-add-outline" class="auth-icon"></ion-icon>
        <h1>Crear cuenta</h1>
        <p>Crea tu cuenta en la Liga Chivilcoyana</p>
    </header>

    <form method="POST" action="{{ route('register.store') }}" class="auth-form">
        @csrf

        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" required>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <button type="submit">Registrarme</button>
    </form>

    <footer class="auth-footer">
        <p>¿Ya tienes una cuenta?
            <a href="{{ route('login') }}">Inicie sesion aquí</a>
        </p>
    </footer>

</section>
@endsection
