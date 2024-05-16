<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capturar Calificaciones</title>
    <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- DataTables Buttons CSS -->
  <link href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
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
    <h2>Capturar Calificaciones</h2>
    </center>
    <form id="grupoForm">
        <label for="grupo">Seleccione un grupo:</label>
        <select name="grupo" id="grupo">
            <option value="">Todos los grupos</option>
            @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
            @endforeach
        </select>
        <button type="submit">Filtrar</button>
    </form>

    @if (!empty($selectedGrupo))
        <form action="{{ route('guardar_calificaciones') }}" method="POST">
            @csrf
            <input type="hidden" name="id_grupo" value="{{ $selectedGrupo }}"> <!-- Campo oculto para el id_grupo -->
            <label for="maestro">Maestro:</label>
            <input type="text" name="maestro" id="maestro" value="{{ old('maestro') }}" required>
            <div>
                <label>Bloque: </label>
                <select class="form-control mb-3" name="bloque">
                    <option value="1">Bloque 1</option>
                    <option value="2">Bloque 2</option>
                    <option value="3">Bloque 3</option>
                </select>
            </div>

            <table id="reg_cal" class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Grupo</th>
                        @foreach ($materias as $materia)
                            <th>{{ $materia->nombre_materia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->grupos->nombre }}</td>
                            @foreach ($materias as $materia)
                                <td>
                                    <input type="number" name="calificaciones[{{ $alumno->id }}][{{ $materia->id }}]" step="0.01" min="0" max="100">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <button type="submit">Guardar Calificaciones</button>
        </form>
        <button id="imprimir-pdf" class="btn btn-primary">Imprimir PDF</button>
    @endif
    <br>
    <a class="btn btn-success" href="{{url('home')}}">Regresar</a>
  </div>
    <script>
        // Función para enviar automáticamente el formulario cuando se selecciona un grupo
        document.getElementById('grupo').addEventListener('change', function() {
            document.getElementById('grupoForm').submit();
        });
    </script>
    <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
  <!-- PDFMake JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
  <!-- DataTables Buttons PDF JS -->
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

  <script>
    $(document).ready(function() {
        // Agregar función para imprimir PDF
        $('#imprimir-pdf').on('click', function() {
            window.print();
        });
    });
  </script>
</body>
</html>