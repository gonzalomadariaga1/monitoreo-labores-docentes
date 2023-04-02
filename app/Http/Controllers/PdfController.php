<?php

namespace App\Http\Controllers;

use PDF;

use DateTime;
use App\Docente;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\AsignacionDocentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{

    public function downloadPDFMemo($id_docente,$correlativo,$fecha){

        
        $a = DB::table('td_asign_docen')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
        ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('referencia','anotaciones.referencia_id','=','referencia.id')
        ->where('tipo_tarea.id','=','2')
        ->where('docentes.id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('td_asign_docen.estado','=','1')
        ->select(   
                    'tipo_tarea.nombre as anotacion',
                    //'anotaciones.id as id_anotacion',
                    'referencia.nombre as referencia',
                    'anotaciones.fecha',
                    'td_asign_docen.docente_id as id_docente',
                    DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                    'asignaturas.id as id_asignatura',
                    'asignaturas.nombre as nombre_asignatura',
                    'tareas_detalle.tarea_id as id_tarea',
                    'tarea.nombre as nombre_tarea',
                    'td_asign_docen.curso_id as id_curso',
                    DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),
                )
        ->orderBy('td_asign_docen.docente_id')
        ->get()
        ->groupBy(['nombre_tarea', 'nombre_asignatura']);

        //dd($a);

        // $fecha = DB::table('td_asign_docen')
        //     ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')

        $data_referencia = DB::table('td_asign_docen')
            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
            ->join('referencia','anotaciones.referencia_id','=','referencia.id')
            ->where('td_asign_docen.docente_id','=',$id_docente)
            ->first();

        
        $nombre_docente = Docente::where('id',$id_docente)->first();

  
        $fecha_to_pdf = Carbon::createFromFormat('Y-m-d', $fecha)->format('d-m-Y');

        //dd($fecha_to_pdf);
        
        $ref = $data_referencia->nombre;
        


        $pdf = PDF::loadView('pdf.plantilla_memo',[
            'nombre_docente' => $nombre_docente->getNombreCompleto(),
            'fecha' => $fecha_to_pdf,
            'ref' => $ref,
            'grouped' => '',
            'curses' => $a,
            'correlativo' => $correlativo
        ]);
        return $pdf->setPaper('letter', 'portrait')->stream($correlativo.'-'.$nombre_docente->getNombreCompleto().'.pdf');

    }

    public function downloadPDFAmon($id_docente,$correlativo,$fecha){

      
        $a = DB::table('td_asign_docen')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
        ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('referencia','anotaciones.referencia_id','=','referencia.id')
        ->where('tipo_tarea.id','=','1')
        ->where('docentes.id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('td_asign_docen.estado','=','1')
        ->select(   
                    'tipo_tarea.nombre as anotacion',
                    //'td_asign_docen.id as id_tddddd',
                    //'anotaciones.id as id_anotacion',
                    'referencia.nombre as referencia',
                    //'anotaciones.fecha',
                    'td_asign_docen.docente_id as id_docente',
                    DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                    'asignaturas.id as id_asignatura',
                    'asignaturas.nombre as nombre_asignatura',
                    'tareas_detalle.tarea_id as id_tarea',
                    'tarea.nombre as nombre_tarea',
                    'td_asign_docen.curso_id as id_curso',
                    DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),
                )
        ->orderBy('td_asign_docen.docente_id')
        ->get()
        ->groupBy(['nombre_tarea', 'nombre_asignatura']);


        //dd($a);


        $data_referencia = DB::table('td_asign_docen')
            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
            ->join('referencia','anotaciones.referencia_id','=','referencia.id')
            ->where('td_asign_docen.docente_id','=',$id_docente)
            ->first();

               
        $nombre_docente = Docente::where('id',$id_docente)->first();
        $fecha_to_pdf = Carbon::createFromFormat('Y-m-d', $fecha)->format('d-m-Y');
        $ref = $data_referencia->nombre;

        $user = Auth::user()->name;

        
        

        $pdf = PDF::loadView('pdf.plantilla_amon',[
            'nombre_docente' => $nombre_docente->getNombreCompleto(),
            'fecha' => $fecha_to_pdf,
            'ref' => $ref,
            'grouped' => '',
            'curses' => $a,
            'correlativo' => $correlativo,
            'user'=> $user
        ]);
        return $pdf->setPaper('letter', 'portrait')->stream($correlativo.'-'.$nombre_docente->getNombreCompleto().'.pdf');

    }
}
