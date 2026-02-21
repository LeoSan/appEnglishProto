<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'profesor_id',
        'nivel',
        'etiqueta',
        'titulo',
        'contenido',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function multimedias()
    {
        return $this->hasMany(Multimedia::class);
    }
}
