<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table ='asignaturas';

    protected $fillable = [
        'nombre'
    ];

    public function docentes()
    {
        return $this->belongsToMany('App\Docente','cursos_asignaturas_docentes','asignatura_id','docente_id');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso','cursos_asignaturas_docentes','asignatura_id','curso_id');
    }

    public function anotaciones()
    {
        return $this->belongsToMany('App\Anotacion','td_asign_docen','asignatura_id','anotacion_id');
    }

}
