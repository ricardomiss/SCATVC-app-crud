<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
    <h2>Dashboard Registro de Alumnos</h2>
    </center>
    <table id="alumnos" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Fecha de Nacimiento</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Artes</th>
                <th>Educacion Fisica</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $alumno)
            <tr>
                <td>{{$alumno->nombre}}</td>
                <td>{{$alumno->grupos->nombre}}</td>
                <td>{{$alumno->fecha_nacimiento}}</td>
                <td>{{$alumno->direccion}}</td>
                <td>{{$alumno->telefono}}</td>
                <td>{{$alumno->email}}</td>
                <td>{{ $alumno->artes->nombre }}</td>
                <td>{{ $alumno->fisicas->nombre }}</td>
                <td>
                  <a onclick="return confirm('¿Estas seguro de eliminar el registro?');" class="btn btn-danger" href="{{url('delete_alumno',$alumno->id)}}">Delete</a>
                  <a class="btn btn-primary" href="{{url('update_alumno',$alumno->id)}}">Modificar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <br>
    <a class="btn btn-success" href="{{url('home')}}">Regresar</a>
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
        $('#alumnos').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'pdfHtml5'
            ]
        });
    });
  </script>
</body>
</html>
