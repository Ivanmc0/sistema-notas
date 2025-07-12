<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelacionFamiliar extends Model
{
    protected $table = 'relaciones_familiares';
    protected $fillable = ['padre_id', 'estudiante_id', 'parentesco'];

    public function acudiente()
    {
        return $this->belongsTo(User::class, 'padre_id'); // en realidad es el acudiente
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }
}
