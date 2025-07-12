<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnioLectivo extends Model
{
    protected $table = 'anio_lectivo';
    protected $fillable = ['anio', 'activo'];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    public function periodos()
    {
        return $this->hasMany(Periodo::class);
    }
}
