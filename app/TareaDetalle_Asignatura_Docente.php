<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaDetalle_Asignatura_Docente extends Model
{
    protected $table ='td_asign_docen';

    protected $fillable = [
        'anotacion_id',
        'docente_id',
        'asignatura_id',
        'curso_id'
    ];

    public function tareas()
    {
        return $this->belongsToMany('App\Tarea','tareas_detalle','td_asign_docen_id','tarea_id');
    }



}
