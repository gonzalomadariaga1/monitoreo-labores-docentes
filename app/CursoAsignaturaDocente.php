<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoAsignaturaDocente extends Model
{
    protected $table ='cursos_asignaturas_docentes';

    protected $fillable = [
        'curso_id',
        'docente_id',
        'asignatura_id',
    ];
}
