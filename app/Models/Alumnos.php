<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    public function grupos(){
        return $this->belongsTo(Grupos::class, 'grupo_id');
    }
    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'alumno_id');
    }
    public function artes(){
        return $this->belongsTo(Arte::class, 'arte_id');
    }
    public function fisicas(){
        return $this->belongsTo(Fisica::class, 'fisica_id');
    }
}
