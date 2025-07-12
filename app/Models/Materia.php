<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'grado_id'];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
