<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;
use App\Models\Asignacion;
use App\Models\Periodo;

class Nota extends Model
{
    protected $fillable = ['matricula_id', 'asignacion_id', 'periodo_id', 'calificacion', 'estudiante_id'];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

}
