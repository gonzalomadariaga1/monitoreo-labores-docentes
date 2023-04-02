<?php

namespace App\Imports;



use DB;

use App\Asignatura;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class AsignaturasImport implements ToModel,
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

        $asignatura = new Asignatura;
        $asignatura->nombre = $row['nombre'];
        $asignatura->save();
        
        //dd($productos);
    }

    public function rules(): array{
        return [
            'nombre' => 'required'
        ];
    }

    public function customValidationMessages(){
        return [
            'nombre.required' => 'El nombre de la asignatura es requerido.',

            
        ];
    }
}
