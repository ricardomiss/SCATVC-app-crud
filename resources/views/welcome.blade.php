@extends('layouts.app')

@section('content')
<!-- Enlace al archivo CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container-fluid">
  <div class="row">
    <!-- Columna izquierda para el texto de bienvenida -->
    <div class="col-md-6 text-center">
      <div class="mt-5">
        <img src="{{ asset('carrusel/logo.png') }}" alt="inicio" width=200 height=180>
        <h1>Bienvenido a nuestra aplicación</h1>
        <h3>Sistema de Control Academico de la Telesecundaria Venustiano Carranza</h3>
      </div>
    </div>
    <!-- Columna derecha para la imagen estática -->
    <div class="col-md-6">
      <div class="mt-5">
        <img src="{{ asset('carrusel/imagen3.jpg') }}" class="img-fluid" alt="Imagen estática">
      </div>
    </div>
  </div>
</div>
@endsection
