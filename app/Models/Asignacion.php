<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;
use App\Models\Curso;
use App\Models\User;

class Asignacion extends Model
{
    protected $table = 'asignaciones';
    protected $fillable = ['profesor_id', 'materia_id', 'curso_id'];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
