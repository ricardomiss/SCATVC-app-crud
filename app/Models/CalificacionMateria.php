<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionMateria extends Model
{
    use HasFactory;
    protected $fillable = ['id_alumno', 'id_grupo', 'id_materia', 'calificacion', 'maestro','bloque'];

    // Relación con la tabla alumnos
    public function alumno()
    {
        return $this->belongsTo(Alumnos::class, 'id_alumno');
    }

    // Relación con la tabla grupos
    public function grupo()
    {
        return $this->belongsTo(Grupos::class, 'id_grupo');
    }

    // Relación con la tabla materias
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }
}
