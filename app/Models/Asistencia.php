<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    public function alumnos()
{
    return $this->belongsTo(Alumnos::class, 'alumno_id');
}
public function grupo()
    {
        return $this->belongsTo(Grupos::class, 'id_grupo');
    }

}
