<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;
use App\Models\Grupos;
use App\Models\CalificacionMateria;
use App\Models\Materia;


class CalificacionesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los grupos
        $grupos = Grupos::all();
    
        // Obtener todos los alumnos (o filtrar por grupo si se seleccionó uno)
        $alumnos = Alumnos::when($request->grupo, function ($query, $grupo) {
            return $query->where('grupo_id', $grupo);
        })->get();
    
        // Verificar si se ha seleccionado un alumno
        $alumnoSeleccionado = Alumnos::find($request->alumno);
    
        // Obtener todas las calificaciones (o filtrar por grupo y alumno si se seleccionaron)
        $calificaciones = CalificacionMateria::with(['alumno', 'grupo', 'materia'])
            ->when($request->filter == 'group', function ($query) use ($request) {
                return $query->whereHas('alumno', function ($query) use ($request) {
                    $query->where('grupo_id', $request->grupo);
                });
            })
            ->when($request->filter == 'student', function ($query) use ($request) {
                return $query->where('id_alumno', $request->alumno);
            })
            ->get();
            // Calcular el promedio de las calificaciones del alumno
        $promedio = $calificaciones->avg('calificacion');

        $calificacionesBloque1 = $calificaciones->where('bloque', 1);
        $calificacionesBloque2 = $calificaciones->where('bloque', 2);
        $calificacionesBloque3 = $calificaciones->where('bloque', 3);
        $promedioBloque1 = $calificacionesBloque1->avg('calificacion');
        $promedioBloque2 = $calificacionesBloque2->avg('calificacion');
        $promedioBloque3 = $calificacionesBloque3->avg('calificacion');
        // Retornar la vista con los datos necesarios
        //return view('calificaciones', compact('calificaciones', 'grupos', 'alumnos', 'alumnoSeleccionado','promedio'));
        return view('calificaciones', 
        ['calificacionesBloque1' => $calificacionesBloque1,'calificacionesBloque2' => $calificacionesBloque2,'calificacionesBloque3' => $calificacionesBloque3,'promedioBloque1' => $promedioBloque1, 'promedioBloque2' => $promedioBloque2,'promedioBloque3' => $promedioBloque3,],
        compact('calificaciones', 'grupos', 'alumnos', 'alumnoSeleccionado','promedio'));
    }

    public function capturar(Request $request)
{
    // Obtener todos los grupos
    $grupos = Grupos::all();
    
    // Obtener el ID del grupo seleccionado
    $selectedGrupo = $request->input('grupo');
    
    // Inicializar variables para almacenar los alumnos y materias del grupo seleccionado
    $alumnos = [];
    $materias = [];
    
    // Verificar si se ha seleccionado un grupo
    if ($selectedGrupo) {
        // Obtener los alumnos asociados al grupo seleccionado
        $alumnos = Alumnos::whereHas('grupos', function ($query) use ($selectedGrupo) {
            $query->where('id', $selectedGrupo);
        })->get();
        
        // Obtener las materias asociadas al grupo seleccionado
        $grupo = Grupos::find($selectedGrupo);
        $materias = $grupo->materias();
    }
    
    // Retornar la vista de captura de calificaciones con los datos necesarios
    return view('capturar_calificaciones', compact('grupos', 'materias', 'selectedGrupo', 'alumnos'));
}

    
    
    public function guardar(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'id_grupo' => 'required|exists:grupos,id',
            'calificaciones' => 'required|array',
            'calificaciones.*' => 'array',
            'calificaciones..' => 'numeric|min:0|max:100',
            'maestro' => 'required|string', // Asegúrate de incluir el campo maestro en las reglas de validación
            'bloque' => 'required|int',
        ]);
    
        // Obtén el ID del grupo desde la solicitud
        $idGrupo = $request->input('id_grupo');
        $maestro = $request->input('maestro');
        $bloque = $request->input('bloque');
    
        // Iterar sobre las calificaciones enviadas en la solicitud
        foreach ($request->calificaciones as $alumnoId => $calificacionesPorMateria) {
            foreach ($calificacionesPorMateria as $materiaId => $calificacion) {
                // Crear o actualizar la calificación en la base de datos
                CalificacionMateria::updateOrCreate(
                    [
                        'id_alumno' => $alumnoId,
                        'id_materia' => $materiaId,
                        'id_grupo' => $idGrupo, // Asegúrate de incluir el id_grupo aquí
                    ],
                    [
                        'calificacion' => $calificacion,
                        'maestro' => $maestro, // Aquí asignamos el valor del maestro
                        'bloque' => $bloque,
                    ]
                );
            }
        }
    
        // Redireccionar o retornar una respuesta según lo necesites
        return redirect()->back()->with('success', 'Calificaciones guardadas exitosamente.');
    }
    
    public function buscarAlumnos(Request $request)
{
    // Obtener el término de búsqueda del formulario
    $searchTerm = $request->input('search');

    // Realizar la búsqueda de alumnos según el término de búsqueda
    $alumnos = Alumnos::where('nombre', 'like', '%' . $searchTerm . '%')->get();

    // Retornar la vista con los resultados de la búsqueda
    return view('capturar_calificaciones', compact('alumnos'));
}
}