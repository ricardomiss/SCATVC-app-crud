<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Alumnos;
use App\Models\Grupos;

class AsistenciaController extends Controller
{
    //
    public function index()
{
    
    return view('buscar-usuarios');
}

public function visualizar()
{
    session()->forget('buscando');
    $asistencias = Asistencia::all();
    $grupos = Grupos::all();
    return view('asistencias', compact('asistencias', 'grupos'));
}
public function buscar(Request $request)
{
    $grupo_id = $request->input('grupo_id');
    $bloque = $request->input('bloque');

    $fechas = [
        1 => '01-01',
        2 => '04-01',
        3 => '07-01',
        4 => '10-01',
    ];

    $bloqueInicio = date('Y') . '-' . $fechas[$bloque];
    $bloqueFin = isset($fechas[$bloque + 1]) ? date('Y') . '-' . $fechas[$bloque + 1] : date('Y-m-d');

    $grupos = Grupos::all();
    session(['buscando' => true]);

    $asistencias = Asistencia::whereHas('alumnos.grupos', function ($query) use ($grupo_id) {
        $query->where('id', $grupo_id);
    })
    ->whereBetween('fecha_asistencia', [$bloqueInicio, $bloqueFin])
    ->orderBy('fecha_asistencia')
    ->get();
    
    $asistenciasPorAlumnoYSemana = $asistencias->groupBy([
        function($item) {
            return \Carbon\Carbon::parse($item->fecha_asistencia)->format('W');
        },
        'alumnos.nombre'
    ]);
    
    $fechasPorSemana = $asistencias->groupBy(function($item) {
        return \Carbon\Carbon::parse($item->fecha_asistencia)->format('W');
    })->map(function($item) {
        return $item->pluck('fecha_asistencia')->unique()->sort();
    });


    /*$asistencias = Asistencia::whereHas('alumnos.grupos', function ($query) use ($grupo_id) {
        $query->where('id', $grupo_id);
    })
    ->whereBetween('fecha_asistencia', [$bloqueInicio, $bloqueFin])
    ->orderBy('fecha_asistencia')
    ->get()
    ->groupBy(function($item) {
        return \Carbon\Carbon::parse($item->fecha_asistencia)->format('W');
    });*/
    //return view('asistencias', ['asistencias' => $asistencias,'grupos' => $grupos]);
    
    return view('asistencias', ['asistenciasPorAlumnoYSemana' => $asistenciasPorAlumnoYSemana, 'fechasPorSemana' => $fechasPorSemana, 'grupos' => $grupos]);
}


public function store(Request $request)
{
    $request->validate([
        // No es necesario validar campos que no se envían directamente desde el formulario
    ]);

    foreach ($request->asistencias as $alumno_id => $asistio) {
        // Crear una nueva instancia de Asistencia para cada alumno
        $asistencia = new Asistencia();
        $asistencia->alumno_id = $alumno_id;
        $asistencia->maestro = $request->maestro; // Asignar el mismo maestro para todos los alumnos
        $asistencia->fecha_asistencia = $request->fecha_asistencia; // Asignar la misma fecha de asistencia para todos los alumnos
        $asistencia->asistio = $asistio;
        $asistencia->save();
    }

    return redirect()->back()->with('success', 'Asistencias registradas correctamente');
}


}
