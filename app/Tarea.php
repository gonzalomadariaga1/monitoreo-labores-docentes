<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table ='tarea';

    protected $fillable = [
        'nombre',
        'slug_nombre',
        'tipo_tarea_id'
    ];


    public function tipotarea()
    {
        return $this->belongsTo('App\TipoTarea' , 'tipo_tarea_id');
    }

    public function tareadetalle_asign_docente()
    {
        return $this->belongsToMany('App\TareaDetalle_Asignatura_Docente','tareas_detalle','tarea_id','td_asign_docen_id');
    }
}
