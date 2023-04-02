<?php

namespace App\Imports;



use DB;

use App\Curso;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CursosImport implements ToModel,
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

        $cursos = new Curso;

        $cursos->nivel = $row['nivel'];
        $cursos->letra = $row['letra'];


       
        $cursos->save();

        
        //dd($productos);
    }

    public function rules(): array{
        return [
            'nivel' => 'required',
            'letra' => 'required'
        ];
    }

    public function customValidationMessages(){
        return [
            'nivel.required' => 'El nivel del curso es requerido.',
            'letra.required' => 'La letra del curso es requerido.',

            
        ];
    }
}
