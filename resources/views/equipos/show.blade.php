@extends('layouts.app')

@section('title', 'Mi equipo')

@push('styles')
    @vite('resources/css/equipos/show.css')
@endpush

@section('content')
<div class="container">

    <h1>{{ $equipo->nombre }}</h1>


</div>
@endsection
