<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'user_id',
        'profesor_id',
        'matricula',
        'nombre',
        'apellidos',
        'nivel',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'direccion',
        'fecha_inscripcion',
        'activo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
