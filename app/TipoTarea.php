<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTarea extends Model
{
    protected $table ='tipo_tarea';

    protected $fillable = [
        'nombre',
        'slug_nombre'
    ];

    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }

    
}
