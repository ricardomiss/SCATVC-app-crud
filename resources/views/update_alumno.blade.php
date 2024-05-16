<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Enlace al archivo CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
        <!-- Aquí puedes colocar tu imagen de logo -->
        <img src="{{ asset('carrusel/logo.png') }}" alt="Logo de la empresa">
        <!-- Resto del contenido del encabezado -->
    </header>

  <div class="container mt-5">
    <center>
    <h2>Modificar Registro de Alumnos</h2>
</center>
    <form action="{{url('/edit_alumno',$data->id)}}" method="POST">
        @csrf
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$data->nombre}}">
      </div>
      <div class="form-group">
        <label for="grupo">Grupo:</label>
        <select class="form-control select" id="grupo_id" name="grupo_id" required>
        <option value="">Seleccionar...</option>
          @foreach ($grupos as $grupo)
            <option value="{{ $grupo->id }}" {{ $data->grupo_id == $grupo->id ? 'selected' : '' }}>
              {{ $grupo->nombre }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{$data->fecha_nacimiento}}">
      </div>
      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="{{$data->direccion}}">
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" value="{{$data->telefono}}">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}">
      </div>
      <!-- Nuevo combobox para actividades de artes -->
      <div class="form-group">
        <label for="actividad_artes">Actividad de Artes:</label>
        <select class="form-control select" id="arte_id" name="arte_id" required>
          <option value="">Seleccionar...</option>
            @foreach ($artes as $arte)
          <option value="{{ $arte->id }}" {{ $data->arte_id == $arte->id ? 'selected' : '' }}>
            {{ $arte->nombre }}
          </option>
            @endforeach
        </select>
      </div>
       
      <!-- Nuevo combobox para actividades de educación física -->
      <div class="form-group">
        <label for="actividad_educacion_fisica">Actividad de Educación Física:</label>
        <select class="form-control select" id="fisica_id" name="fisica_id" required>
          <option value="">Seleccionar...</option>
            @foreach ($fisicas as $fisica)
          <option value="{{ $fisica->id }}" {{ $data->fisica_id == $fisica->id ? 'selected' : '' }}>
            {{ $fisica->nombre }}
          </option>
            @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    <br>
    <a class="btn btn-success" href="{{url('/home')}}">Regresar</a>
  </div>

  <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades adicionales de Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
