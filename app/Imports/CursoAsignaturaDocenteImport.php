<?php

namespace App\Imports;

use DB;

use App\CursoAsignaturaDocente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CursoAsignaturaDocenteImport implements ToModel,
WithHeadingRow,
WithValidation,WithCalculatedFormulas
{
     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $curso_asignatura_docente = new CursoAsignaturaDocente;

        $curso_asignatura_docente->curso_id = $row['curso_id'];
        $curso_asignatura_docente->asignatura_id = $row['asignatura_id'];
        $curso_asignatura_docente->docente_id = $row['docente_id'];


       
        $curso_asignatura_docente->save();

        
        //dd($productos);
    }

    public function rules(): array{
        return [
            'curso_id' => 'required',
            'asignatura_id' => 'required',
            //'docente_id' => 'required',
        ];
    }

    public function customValidationMessages(){
        return [
            'curso_id.required' => 'El curso_id es requerido.',
            'asignatura_id.required' => 'La asignatura_id es requerido.',
            //'docente_id.required' => 'El docente_id es requerido.',

            
        ];
    }
}
