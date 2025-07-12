<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;
use App\Models\Asignacion;
use App\Models\Periodo;
use App\Models\Materia;
use App\Models\Curso;
use App\Models\User;

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

    // Relaciones para el sistema de reportes
    public function materia()
    {
        return $this->hasOneThrough(
            Materia::class,
            Asignacion::class,
            'id', // Clave foránea en asignaciones
            'id', // Clave primaria en materias
            'asignacion_id', // Clave foránea en notas
            'materia_id' // Clave foránea en asignaciones
        );
    }

    public function curso()
    {
        return $this->hasOneThrough(
            Curso::class,
            Asignacion::class,
            'id', // Clave foránea en asignaciones
            'id', // Clave primaria en cursos
            'asignacion_id', // Clave foránea en notas
            'curso_id' // Clave foránea en asignaciones
        );
    }

    public function profesor()
    {
        return $this->hasOneThrough(
            User::class,
            Asignacion::class,
            'id', // Clave foránea en asignaciones
            'id', // Clave primaria en users
            'asignacion_id', // Clave foránea en notas
            'profesor_id' // Clave foránea en asignaciones
        );
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

}
