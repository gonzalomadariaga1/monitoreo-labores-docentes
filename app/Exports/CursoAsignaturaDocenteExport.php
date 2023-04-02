<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CursoAsignaturaDocenteExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'curso_id',
            'asignatura_id',
            'docente_id',
        ];
    }
}
