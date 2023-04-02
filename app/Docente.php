<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table ='docentes';

    protected $fillable = [
        'rut',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
    ];

    public function getNombreCompleto(){
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function asignaturas()
    {
        return $this->belongsToMany('App\Asignatura','cursos_asignaturas_docentes','docente_id','asignatura_id');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso','cursos_asignaturas_docentes','docente_id','curso_id');
    }

    public function anotaciones()
    {
        return $this->belongsToMany('App\Anotacion','td_asign_docen','docente_id','anotacion_id');
    }
}
