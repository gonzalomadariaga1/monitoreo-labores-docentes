<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaDetalle extends Model
{
    protected $table ='tareas_detalle';

    protected $fillable = [
        'tarea_id',
        'td_asign_docen_id',
    ];
    
    
}
