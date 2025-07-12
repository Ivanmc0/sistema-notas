<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = ['nombre', 'inicio', 'fin', 'anio_lectivo_id'];

    public function anioLectivo()
    {
        return $this->belongsTo(AnioLectivo::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
