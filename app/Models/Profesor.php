<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = [
        'user_id',
        'numero_empleado',
        'nombre',
        'apellidos',
        'tipo_identificacion',
        'num_identificacion',
        'especialidad',
        'telefono',
        'url_foto',
        'fecha_contratacion',
        'activo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }
}
