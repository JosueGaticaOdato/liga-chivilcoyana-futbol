@extends('layouts.app')

@section('title', 'Iniciar sesion')

@push('styles')
    @vite('resources/css/auth/login.css')
@endpush

@section('content')

<section class="auth-container">

    <h1>Iniciar sesión</h1>

    <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required autofocus>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">Ingresar</button>
    </form>

</section>
@endsection
