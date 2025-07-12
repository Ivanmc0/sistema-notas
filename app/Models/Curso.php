<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['grado_id', 'seccion', 'anio_lectivo_id'];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function anioLectivo()
    {
        return $this->belongsTo(AnioLectivo::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

}
