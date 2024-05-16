<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex del Alumno</title>
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
    <h2>Kardex del Alumno</h2>
    </center>
    <form action="{{ route('calificaciones.index') }}" method="GET">
        <label for="grupo">Grupo:</label>
        <select name="grupo" id="grupo">
            <option value="">Seleccione un grupo</option>
            @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
            @endforeach
        </select>
        <button type="submit" name="filter" value="group">Filtrar por Grupo</button>
    </form>

    <form action="{{ route('calificaciones.index') }}" method="GET">
        <label for="alumno">Alumno:</label>
        <select name="alumno" id="alumno">
            <option value="">Seleccione un alumno</option>
            @foreach ($alumnos as $alumno)
                <option value="{{ $alumno->id }}">{{ $alumno->nombre }}</option>
            @endforeach
        </select>
        <button type="submit" name="filter" value="student">Filtrar por Alumno</button>
    </form>

    <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="bloque1-tab" data-toggle="pill" href="#bloque1" role="tab" aria-controls="bloque1" aria-selected="true">Bloque 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bloque2-tab" data-toggle="pill" href="#bloque2" role="tab" aria-controls="bloque2" aria-selected="false">Bloque 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bloque3-tab" data-toggle="pill" href="#bloque3" role="tab" aria-controls="bloque3" aria-selected="false">Bloque 3</a>
        </li>
    </ul>
    @if ($alumnoSeleccionado)
    @foreach ($calificaciones as $calificacion)
    <div class="alert alert-primary row mt-3" role="alert">
        <div class="col align-self-start">
            <h4>Alumno: {{ $alumnoSeleccionado->nombre }}</h4>
            <h4>Grupo: {{ $alumnoSeleccionado->grupos->nombre }}</h4>
        </div>
        <div class="col align-self-start">
            <h4 class="text-right">Maestro: {{ $calificacion->maestro }} </h4>
            <h4 class="text-right">Promedio General: {{ number_format($promedio, 2) }}</h4> 

        </div>
    </div>
        @break
    @endforeach
    <div class="tab-content">
        <div class="tab-pane active" id="bloque1" role="tabpanel" aria-labelledby="bloque1-tab">
            <!-- Aquí se muestra el promedio -->
            <div class="alert alert-info mt-3" role="alert">
                <strong>Promedio Bloque 1:</strong> {{ $promedioBloque1 ?? 'N/A' }}
            </div>
            <table id="kardex" class="table">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificacionesBloque1 as $calificacion)
                        <tr>
                            <td>{{ $calificacion->materia->nombre_materia }}</td>
                            <td class="text-center">{{ $calificacion->calificacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="bloque2" role="tabpanel" aria-labelledby="bloque2-tab">
            <!-- Aquí se muestra el promedio -->
            <div class="alert alert-info mt-3" role="alert">
                <strong>Promedio Bloque 2:</strong> {{ $promedioBloque2 ?? 'N/A' }}
            </div>
            <table id="kardex" class="table">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificacionesBloque2 as $calificacion)
                        <tr>
                            <td>{{ $calificacion->materia->nombre_materia }}</td>
                            <td class="text-center">{{ $calificacion->calificacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="bloque3" role="tabpanel" aria-labelledby="bloque3-tab">
            <!-- Aquí se muestra el promedio -->
            <div class="alert alert-info mt-3" role="alert">
                <strong>Promedio Bloque 3:</strong> {{ $promedioBloque3 ?? 'N/A' }}
            </div>
            <table id="kardex" class="table">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificacionesBloque3 as $calificacion)
                        <tr>
                            <td>{{ $calificacion->materia->nombre_materia }}</td>
                            <td class="text-center">{{ $calificacion->calificacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <a class="btn btn-success mt-3" href="{{url('home')}}">Regresar</a>
  </div>
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
        $('table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'pdfHtml5'
            ]
        });
    });
  </script>
</body>
</html>
