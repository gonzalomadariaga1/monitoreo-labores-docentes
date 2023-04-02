<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocentesTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'RUT',
            'nombres',
            'apellido_paterno',
            'apellido_materno',
        ];
    }
}
