@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<section class="auth-container">

    <h1>Crear cuenta</h1>

    <form method="POST" action="{{ route('register.store') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required>
        </div>

        @if ($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <button type="submit">Registrarme</button>
    </form>

</section>
@endsection
