<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacion extends Model
{
    protected $table ='anotaciones';

    protected $fillable = [
        'estado',
        'fecha',
        'referencia_id',
    ];

    public function referencia()
    {
        return $this->belongsTo('App\Referencia' , 'referencia_id');
    }

    public function asignaturas()
    {
        return $this->belongsToMany('App\Asignatura','td_asign_docen','anotacion_id','asignatura_id');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso','td_asign_docen','anotacion_id','curso_id');
    }

    public function docentes()
    {
        return $this->belongsToMany('App\Docente','td_asign_docen','anotacion_id','docente_id');
    }
}
