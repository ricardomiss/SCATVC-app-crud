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
    <h2>Formulario Registro de Alumnos</h2>
</center>
    <form action="{{url('/add_alumno')}}" method="POST">
        @csrf
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="grupo">Grupo:</label>
          <select class="form-control" id="grupo_id" name="grupo_id">
            <option value="">Seleccione...</option>
              <option value="1">1A</option>
              <option value="2">1B</option>
              <option value="3">1C</option>
              <option value="4">2A</option>
              <option value="5">2B</option>
              <option value="6">2C</option>
              <option value="7">3A</option>
              <option value="8">3B</option>
              <option value="9">3C</option>
          </select>
      </div>
      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
      </div>
      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion">
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <!-- Nuevo combobox para actividades de artes -->
      <div class="form-group">
        <label for="actividad_artes">Actividad de Artes:</label>
        <select class="form-control" id="arte_id" name="arte_id">
          <option value="">Seleccione...</option>
          <option value="1">BORDADO TRADICIONAL</option>
          <option value="2">TEATRO</option>
          <option value="3">POESÍA</option>
          <option value="4">ORATORIA</option>
          <option value="5">ZAPATEADO</option>
          <option value="6">PINTURA Y DIBUJO</option>
          <option value="7">LENGUA NAHUATL</option>
          <option value="8">JARANA</option>
          <option value="9">DANZA</option>
          <option value="10">GUITARRA</option>
          <option value="11">TELAR DE CINTURA</option>
          <option value="12">ARTES PLÁSTICAS</option>
        </select>
      </div>
      <!-- Nuevo combobox para actividades de educación física -->
      <div class="form-group">
        <label for="actividad_educacion_fisica">Actividad de Educación Física:</label>
        <select class="form-control" id="fisica_id" name="fisica_id">
          <option value="">Seleccione...</option>
          <option value="1">FÚTBOL</option>
          <option value="2">VOLEIBOL</option>
          <option value="3">DEFENSA PERSONAL</option>
          <option value="4">BOX</option>
          <option value="5">PENTATLÓN</option>
          <option value="6">ZUMBA</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <br>
    <a class="btn btn-success" href="{{url('show_alumno')}}">Dashboard</a>
    <a class="btn btn-danger" href="{{url('home')}}">Salir</a>
  </div>

  <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades adicionales de Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
