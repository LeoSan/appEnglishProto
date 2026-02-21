<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = [
        'clase_id',
        'titulo',
        'descripcion',
        'tipo',
        'url',
    ];

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }
}
