<?php

namespace App\Imports;

use DB;

use App\Docente;


use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class DocentesImport implements ToModel,
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

        $docentes = new Docente;

        

        $rut = Rut::parse($row['rut'])->normalize();
        
        $docentes->rut = $rut;

        $docentes->nombres = $row['nombres'];
        $docentes->apellido_paterno = $row['apellido_paterno'];
        $docentes->apellido_materno = $row['apellido_materno'];


       
        $docentes->save();
        //dd($productos);
    }

    public function rules(): array{
        return [
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'rut'=> 'required|cl_rut'
        ];
    }

    public function customValidationMessages(){
        return [
            'nombres.required' => 'Los nombres del docente es requerido.',
            'apellido_paterno.required' => 'El apellido paterno del docente es requerido.',
            'apellido_materno.required' => 'El apellido materno del docente es requerido.',
            'rut.required' => 'El rut del docente es requerido.',
            'rut.cl_rut' => 'El rut del docente no es válido.',

            
        ];
    }
}
