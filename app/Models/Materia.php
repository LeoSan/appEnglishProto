<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = [
        'nombre',
        'nivel',
        'profesor_id',
        'fecha_inicio',
        'fecha_fin',
        'activa',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }
}
