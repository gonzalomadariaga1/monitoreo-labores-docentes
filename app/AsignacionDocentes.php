<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Asignatura;

class AsignacionDocentes extends Model
{
    protected $table ='td_asign_docen';

    protected $guarded = [];

    public function tareas(){
        return $this->hasMany(Tarea::class,'id');
    }

    public function asignatura(){
        return $this->hasMany(Asignatura::class,'id');
    }

    public function curso(){
        return $this->hasMany(Curso::class,'id');
    } 
    public function anotaciones(){
        return $this->hasMany(Anotacion::class,'id');
    } 
}
