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
            <h2>Formato de Asistencia de Alumnos</h2>
        </center>

        <form action="{{ route('buscar') }}" method="GET">
            <div class="form-group">
                <label for="grupo_id">Grupo:</label>
                <select class="form-control" id="grupo_id" name="grupo_id">
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_asistencia">Fecha de Asistencia:</label>
                <select class="form-control" name="bloque">
                    <option value="1">Primer Bloque</option>
                    <option value="2">Segundo Bloque</option>
                    <option value="3">Tercer Bloque</option>
                </select>
            </div>
            <button class="btn btn-primary">Buscar</button>
        </form>

        @if(session('buscando',false))
            <div id="pdf">
            @foreach($asistenciasPorAlumnoYSemana as $semana => $asistenciasPorAlumno)
                <div class="tab-content mt-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="semana{{ $semana }}" role="tabpanel" aria-labelledby="semana{{ $semana }}-tab">
                        <h3 class="mt-4">Semana {{ $semana }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    @foreach($fechasPorSemana[$semana] as $fecha)
                                        <th scope="col">{{ \Carbon\Carbon::parse($fecha)->format('m-d') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asistenciasPorAlumno as $nombre => $asistenciasAlumno)
                                    <tr>
                                        <td>{{ $nombre }}</td>
                                        @foreach($fechasPorSemana[$semana] as $fecha)
                                            @php
                                                $asistencia = $asistenciasAlumno->firstWhere('fecha_asistencia', $fecha);
                                            @endphp
                                            <td>{{ $asistencia ? $asistencia->asistio : '' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
        <button id="printButton" class="btn btn-primary">Imprimir</button>
        <a class="btn btn-danger" href="{{ url('home') }}">Regresar</a>



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
    document.getElementById('printButton').addEventListener('click', function() {
        var printContents = document.getElementById('pdf').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>
</body>
</html>
