<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_materia'];

    // Relación con la tabla grupos
    public function grupo()
    {
        return $this->belongsTo(Grupos::class, 'grupo_id');
    }

    // Relación con la tabla calificaciones_materia
    public function calificaciones()
    {
        return $this->hasMany(CalificacionMateria::class, 'id_materia');
    }
}