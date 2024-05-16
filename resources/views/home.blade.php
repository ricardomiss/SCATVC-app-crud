@extends('layouts.app')

@section('content')
<!-- Enlace al archivo CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<header>
        <!-- Aquí puedes colocar tu imagen de logo -->
        <img src="{{ asset('carrusel/logo.png') }}" alt="Logo de la empresa">
        <!-- Resto del contenido del encabezado -->
    </header>
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <!-- Mostrar contenido de welcome solo si el usuario no está autenticado -->
            @guest
                @include('welcome')
            @endguest
            
            <!-- Mostrar contenido de inicio solo si el usuario está autenticado -->
            @auth
                @include('inicio')
            @endauth
        </div>
    </div>
</div>
@endsection
