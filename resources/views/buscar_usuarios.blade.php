<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistencias</title>
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
    <h2>Registro de Asistencias Alumnos</h2>
    </center>
    <!-- Formulario para buscar usuarios por grupo -->
    <form action="{{ url('buscar-usuarios') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="grupo_id">Grupo:</label>
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
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Si se encuentran usuarios, mostrar el formulario para registrar asistencias -->
    @if ($usuarios->count() > 0)
        <div class="mt-4">
            <!-- Formulario para registrar asistencias -->
            <form action="{{ route('asistencia.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="maestro">Nombre del Maestro:</label>
                    <input type="text" class="form-control" id="maestro" name="maestro" required>
                </div>
                <div class="form-group">
                    <label for="fecha_asistencia">Fecha de Asistencia:</label>
                    <input type="date" class="form-control" name="fecha_asistencia" id="fecha_asistencia">
                </div>

                <table id="usuarios-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Asistió</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>
                                <select class="form-control" name="asistencias[{{ $usuario->id }}]">
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                    <option value="justificante">Justificante</option>
                                    
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Guardar Asistencias</button>
            </form>
            <button id="imprimir-pdf" class="btn btn-primary">Imprimir PDF</button>
        </div>
    @else
        <p>{{ $mensaje }}</p>
    @endif

    <br>
    <a class="btn btn-danger" href="{{ url('home') }}">Salir</a>
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
        // Agregar función para imprimir PDF
        $('#imprimir-pdf').on('click', function() {
            window.print();
        });
    });
  </script>
</body>
</html>
