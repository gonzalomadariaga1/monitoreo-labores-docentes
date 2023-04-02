<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table ='cursos';

    protected $fillable = [
        'nivel',
        'letra',
    ];

    public function docentes()
    {
        return $this->belongsToMany('App\Docente','cursos_asignaturas_docentes','curso_id','docente_id');
    }

    public function asignaturas()
    {
        return $this->belongsToMany('App\Asignatura','cursos_asignaturas_docentes','curso_id','asignatura_id');
    }

    public function anotaciones()
    {
        return $this->belongsToMany('App\Anotacion','td_asign_docen','curso_id','anotacion_id');
    }

    public function getNombreCursoAttribute(){
       return $this->nivel . ' ' .  $this->letra;
    }

}
