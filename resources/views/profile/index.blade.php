@extends('layouts.app')

@section('title', 'Mi perfil')

@section('content')
<section class="perfil-container">

    <h1>Mi perfil</h1>

    <ul>
        <li><strong>Nombre:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Rol:</strong> {{ ucfirst($user->role) }}</li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Salir de la pagina</button>
    </form>

</section>
@endsection
