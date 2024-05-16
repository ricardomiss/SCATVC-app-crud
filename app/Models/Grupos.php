<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;
    public function  alumnos(){
        return $this->belongsToMany(Alumnos::class);
    }

    public function materias()
    {
        return Materia::where('grupo_id', $this->id)->get();
    }
    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'alumno_id');
    }
    

}
