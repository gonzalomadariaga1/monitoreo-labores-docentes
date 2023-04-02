<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Tarea;
use App\Docente;
use App\Anotacion;
use App\Asignatura;
use App\Referencia;
use App\TareaDetalle;


use App\AsignacionDocentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\TareaDetalle_Asignatura_Docente;
use RealRashid\SweetAlert\Facades\Alert;


class AnotacionesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-anotaciones-create',
        'show' => 'admin-anotaciones-show',
        'edit' => 'admin-anotaciones-edit',
        'delete' => 'admin-anotaciones-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    #estados de anotacion: 
    # 0 -> anulada 
    # 1 -> activa 
    # 2 -> eliminada

    //se obtienen anotaciones que pueden tener estado activo o anulado
    public function get_anotaciones_tipo_memo_groupby_docente(){
        $docentes_con_memos = DB::table('td_asign_docen')
                ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
                ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
                ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
                ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
                ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
                ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
                ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
                ->where('tipo_tarea.id','=','2')
                ->where('td_asign_docen.estado','!=','2')
                ->select(   
                            'anotaciones.fecha',
                            'td_asign_docen.docente_id as id_docente',
                            'td_asign_docen.estado as estado',
                            DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                            'asignaturas.id as id_asignatura',
                            'asignaturas.nombre as nombre_asignatura',
                            'tareas_detalle.tarea_id as id_tarea',
                            'tarea.nombre as nombre_tarea',
                            'td_asign_docen.curso_id as id_curso',
                            DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),

                        )
        ->get();

        $memos = array_group_by($docentes_con_memos->toArray(),'fecha','nombre_docente', 'nombre_tarea', 'nombre_asignatura','nombre_curso');
        //dd($memos);
        $data = [];
        $results = [];
        $correlativo = 1;

        foreach( $memos as $fecha => $docentes){
            $row[0] = $fecha;
            foreach( $docentes as $docente => $tareas){
                $row[1] = $correlativo;
                $row[2] = $docente;
                
                $row[3] = count($tareas);

                foreach($tareas as $key => $asignaturas){
                    $row[4] = count($asignaturas);

                    foreach ($asignaturas as $cursos){

                        $row[5] = count($cursos);
                        
                        foreach($cursos as $in_cursos){
                            foreach($in_cursos as $dat){
                                
                                if( $dat->estado == 1  ){
                                    $row[6]='
                                            <div class="text-center">
                                                <span class="badge bg-success">Activa</span>
                                            </div>
                                            ';
                                }else{
                                    $row[6]='
                                            <div class="text-center">
                                                <span class="badge bg-warning">Anulada</span>
                                            </div>
                                            ';

                                }
                                $row[7]='<div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalMemo('.$dat->id_docente.',\''.$fecha.'\')"><i class="bi bi-eye"></i></a>
                                <a href="/pdf/'.$dat->id_docente.'/'.$correlativo.'/'.$fecha.'/memo" target="_blank"class="btn btn-primary-violet btn-sm mb-1 me-1" ><i class="bi bi-file-earmark-pdf"></i></a>
                                <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalBorrarMemo('.$dat->id_docente.',\''.$fecha.'\','.$dat->estado.')"><i class="bi bi-gear"></i></a>
                                </div> 
                                ';
                                  
                            }
                            
                        }
                    }
                }
                
                
                $data[] = $row;
                $correlativo++;
            }
        }

        //dd($data);


        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);
    }

    //se obtienen anotaciones que pueden tener estado activo o anulado
    public function get_anotaciones_tipo_amonestacion_groupby_docente(){
              
        $docentes_con_amonestaciones = DB::table('td_asign_docen')
                                            ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
                                            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
                                            ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
                                            ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
                                            ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
                                            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
                                            ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
                                            ->where('tipo_tarea.id','=','1')
                                            ->where('td_asign_docen.estado','!=','2')
                                            ->select(   
                                                        'anotaciones.fecha',
                                                        'td_asign_docen.docente_id as id_docente',
                                                        DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                                                        'asignaturas.id as id_asignatura',
                                                        'asignaturas.nombre as nombre_asignatura',
                                                        'tareas_detalle.tarea_id as id_tarea',
                                                        'tarea.nombre as nombre_tarea',
                                                        'td_asign_docen.curso_id as id_curso',
                                                        'td_asign_docen.estado as estado',
                                                        DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),

                                                    )
        ->get();

        //$a = AsignacionDocentes::with('asignatura','tareas','curso')->get();
        

        //dd($a[0]->curso[0]->nombre_curso);
        //dd($docentes_con_amonestaciones);

        $grouped = array_group_by($docentes_con_amonestaciones->toArray(),'fecha','nombre_docente', 'nombre_tarea', 'nombre_asignatura','nombre_curso');

        //dd($grouped);
        $data = [];
        $results = [];
        $correlativo = 1;


        foreach( $grouped as $fecha => $docentes){
            $row[0] = $fecha;
            foreach( $docentes as $docente => $tareas){
                $row[1] = $correlativo;
                $row[2] = $docente;
                
                $row[3] = count($tareas);

                foreach($tareas as $key => $asignaturas){
                    $row[4] = count($asignaturas);

                    foreach ($asignaturas as $cursos){

                        $row[5] = count($cursos);
                        
                        foreach($cursos as $in_cursos){
                            foreach($in_cursos as $dat){
                                if( $dat->estado == 1 ){
                                    $row[6]='
                                            <div class="text-center">
                                                <span class="badge bg-success">Activa</span>
                                            </div>
                                            ';
                                }else{
                                    $row[6]='
                                            <div class="text-center">
                                                <span class="badge bg-warning">Anulada</span>
                                            </div>
                                            ';

                                }
                                $row[7]='<div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalAmonestacion('.$dat->id_docente.',\''.$fecha.'\')"><i class="bi bi-eye"></i></a>
                                <a href="/pdf/'.$dat->id_docente.'/'.$correlativo.'/'.$fecha.'/amon" target="_blank"class="btn btn-primary-violet btn-sm mb-1 me-1" ><i class="bi bi-file-earmark-pdf"></i></a>
                                <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalBorrarAmon('.$dat->id_docente.',\''.$fecha.'\','.$dat->estado.')"><i class="bi bi-gear"></i></a>
                                </div> 
                                ';
                                  
                            }
                            
                        }
                    }
                }
                
                
                $data[] = $row;
                $correlativo++;
            }
        }




        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);
        
    }

    public function get_anotaciones_amon_eliminadas(){
              
        $docentes_con_amonestaciones = DB::table('td_asign_docen')
                                            ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
                                            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
                                            ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
                                            ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
                                            ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
                                            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
                                            ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
                                            ->where('tipo_tarea.id','=','1')
                                            ->where('td_asign_docen.estado','=','2')
                                            ->select(   
                                                        'anotaciones.fecha',
                                                        'td_asign_docen.docente_id as id_docente',
                                                        DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                                                        'asignaturas.id as id_asignatura',
                                                        'asignaturas.nombre as nombre_asignatura',
                                                        'tareas_detalle.tarea_id as id_tarea',
                                                        'tarea.nombre as nombre_tarea',
                                                        'td_asign_docen.curso_id as id_curso',
                                                        'td_asign_docen.estado as estado',
                                                        DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),

                                                    )
        ->get();

        //$a = AsignacionDocentes::with('asignatura','tareas','curso')->get();
        

        //dd($a[0]->curso[0]->nombre_curso);
        //dd($docentes_con_amonestaciones);

        $grouped = array_group_by($docentes_con_amonestaciones->toArray(),'fecha','nombre_docente', 'nombre_tarea', 'nombre_asignatura','nombre_curso');

        //dd($grouped);
        $data = [];
        $results = [];



        foreach( $grouped as $fecha => $docentes){
            $row[0] = $fecha;
            foreach( $docentes as $docente => $tareas){
                $row[1] = $docente;
                
                $row[2] = count($tareas);

                foreach($tareas as $key => $asignaturas){
                    $row[3] = count($asignaturas);

                    foreach ($asignaturas as $cursos){

                        $row[4] = count($cursos);
                        
                        foreach($cursos as $in_cursos){
                            foreach($in_cursos as $dat){
                                if( $dat->estado == 2 ){
                                    $row[5]='
                                            <div class="text-center">
                                                <span class="badge bg-danger">Eliminada</span>
                                            </div>
                                            ';
                                }
                                $row[6]='<div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalBorrar('.$dat->id_docente.',\''.$fecha.'\','.$dat->estado.')"><i class="bi bi-gear"></i></a>
                                </div> 
                                ';
                                  
                            }
                            
                        }
                    }
                }
                
                
                $data[] = $row;
            }
        }




        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);






        
    }
    public function get_anotaciones_memo_eliminadas(){
              
        $docentes_con_amonestaciones = DB::table('td_asign_docen')
                                            ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
                                            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
                                            ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
                                            ->join('cursos','td_asign_docen.curso_id','=','cursos.id')
                                            ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
                                            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
                                            ->join('asignaturas','td_asign_docen.asignatura_id','=','asignaturas.id')
                                            ->where('tipo_tarea.id','=','2')
                                            ->where('td_asign_docen.estado','=','2')
                                            ->select(   
                                                        'anotaciones.fecha',
                                                        'td_asign_docen.docente_id as id_docente',
                                                        DB::raw('CONCAT(docentes.nombres," " ,docentes.apellido_paterno, " ",docentes.apellido_materno) as nombre_docente'),
                                                        'asignaturas.id as id_asignatura',
                                                        'asignaturas.nombre as nombre_asignatura',
                                                        'tareas_detalle.tarea_id as id_tarea',
                                                        'tarea.nombre as nombre_tarea',
                                                        'td_asign_docen.curso_id as id_curso',
                                                        'td_asign_docen.estado as estado',
                                                        DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),

                                                    )
        ->get();

        //$a = AsignacionDocentes::with('asignatura','tareas','curso')->get();
        

        //dd($a[0]->curso[0]->nombre_curso);
        //dd($docentes_con_amonestaciones);

        $grouped = array_group_by($docentes_con_amonestaciones->toArray(),'fecha','nombre_docente', 'nombre_tarea', 'nombre_asignatura','nombre_curso');

        //dd($grouped);
        $data = [];
        $results = [];



        foreach( $grouped as $fecha => $docentes){
            $row[0] = $fecha;
            foreach( $docentes as $docente => $tareas){

                $row[1] = $docente;
                
                $row[2] = count($tareas);

                foreach($tareas as $key => $asignaturas){
                    $row[3] = count($asignaturas);

                    foreach ($asignaturas as $cursos){

                        $row[4] = count($cursos);
                        
                        foreach($cursos as $in_cursos){
                            foreach($in_cursos as $dat){
                                if( $dat->estado == 2 ){
                                    $row[5]='
                                            <div class="text-center">
                                                <span class="badge bg-danger">Eliminada</span>
                                            </div>
                                            ';
                                }
                                $row[6]='<div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-primary-violet btn-sm mb-1 me-1" onclick="mostrarModalBorrar('.$dat->id_docente.',\''.$fecha.'\','.$dat->estado.')"><i class="bi bi-gear"></i></a>
                                </div> 
                                ';
                                  
                            }
                            
                        }
                    }
                }
                
                
                $data[] = $row;

            }
        }




        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);






        
    }
    
    //se obtienen anotaciones que pueden tener estado activo 
    public function show_more_data_memo($id_docente,$fecha){

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

                    //'anotaciones.id as id_anotacion',

                    'anotaciones.fecha',
                    'td_asign_docen.docente_id as id_docente',
                    'asignaturas.id as id_asignatura',
                    'asignaturas.nombre as nombre_asignatura',
                    'tareas_detalle.tarea_id as id_tarea',
                    'tarea.slug_nombre as nombre_tarea',
                    'td_asign_docen.curso_id as id_curso',
                    DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),
                )
        ->orderBy('td_asign_docen.docente_id')
        ->get()
        ->groupBy(['nombre_tarea', 'nombre_asignatura']);

        $docente = Docente::where('id',$id_docente)->first();


        //dd($a);

        $bodycard = 
                    '   <div class="row">
                            <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Docente:</label>
                            <input disabled type="text" class="form-control" id="recipient-name" value="'.$docente->getNombreCompleto().'">
                            </div>
                        </div>
                        <div class="row" id="cards"></div>
                    ';
        
        $resultado = [];

        $resultado [] = [
            'docente' => $bodycard,
            'restoData' => $a

        ];
                    
        
        return $resultado;


    }

    //se obtienen anotaciones que pueden tener estado activo o anulado
    public function show_more_data_amon($id_docente,$fecha){

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

                    //'anotaciones.id as id_anotacion',

                    'anotaciones.fecha',
                    'td_asign_docen.docente_id as id_docente',
                    'asignaturas.id as id_asignatura',
                    'asignaturas.nombre as nombre_asignatura',
                    'tareas_detalle.tarea_id as id_tarea',
                    'tarea.slug_nombre as nombre_tarea',
                    'td_asign_docen.curso_id as id_curso',
                    DB::raw('CONCAT(cursos.nivel, cursos.letra) as nombre_curso'),
                )
        ->orderBy('td_asign_docen.docente_id')
        ->get()
        ->groupBy(['nombre_tarea', 'nombre_asignatura']);

        $docente = Docente::where('id',$id_docente)->first();


        //dd($a);

        $bodycard = 
                    '   <div class="row">
                            <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Docente:</label>
                            <input disabled type="text" class="form-control" id="recipient-name" value="'.$docente->getNombreCompleto().'">
                            </div>
                        </div>
                        <div class="row" id="cards"></div>
                    ';
        
        $resultado = [];

        $resultado [] = [
            'docente' => $bodycard,
            'restoData' => $a

        ];
                    
        
        return $resultado;


    }

    public function borrar_anotacion($id_docente,$fecha){

        $a = DB::table('td_asign_docen')
        ->join('docentes','td_asign_docen.docente_id','=','docentes.id')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->where('docentes.id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->select(   

                    'td_asign_docen.*',
                )
        ->get();
        //dd($a);
        foreach ($a as $key => $value) {
            
            $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
            if ($td_asogn->estado == 2) {
                $td_asogn->estado = 1;
                $td_asogn->update();
                
            } else {
                $td_asogn->estado = 2;
                $td_asogn->update();
                
            }

        }

        if( $a[0]->estado == 2 ){
            Alert::success('¡Buen trabajo!', 'Se ha ACTIVADO la anotación correctamente.')->autoClose(15000);
            return redirect()->route('admin.anotaciones.index'); 
        }else{
            Alert::success('¡Buen trabajo!', 'Se ha ELIMINADO la anotación correctamente.')->autoClose(15000);
            return redirect()->route('admin.anotaciones.index'); 
        }
        // foreach ($a as $key => $value) {
            
        //     $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
        //     $td_asogn->estado = 2;
        //     $td_asogn->update();

        //     Alert::success('¡Buen trabajo!', 'Se ha ELIMINADO la anotación correctamente.')->autoClose(15000);
        //     return redirect()->route('admin.anotaciones.index'); 
            
            
            

        // }



    }

    public function anular_anotacion_memo($id_docente,$fecha){

        $a = DB::table('td_asign_docen')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->where('td_asign_docen.docente_id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('tipo_tarea.id','=','2')
        ->select(   

                    'td_asign_docen.*',
                )
        ->get();

        //dd($a);

        foreach ($a as $key => $value) {
            
            $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
            $td_asogn->estado = 0;
            $td_asogn->update();        

            
        }


        Alert::success('¡Buen trabajo!', 'Se ha ANULADO la anotación correctamente.')->autoClose(15000);
        return redirect()->route('admin.anotaciones.index'); 

    }
    
    public function activar_anotacion_memo($id_docente,$fecha){

        $a = DB::table('td_asign_docen')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->where('td_asign_docen.docente_id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('tipo_tarea.id','=','2')
        ->select(   

                    'td_asign_docen.*',
                )
        ->get();

        //dd($a);

        foreach ($a as $key => $value) {
            
            $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
            $td_asogn->estado = 1;
            $td_asogn->update();         
            
        }


        Alert::success('¡Buen trabajo!', 'Se ha ACTIVADO la anotación correctamente.')->autoClose(15000);
        return redirect()->route('admin.anotaciones.index'); 

    }

    public function anular_anotacion_amon($id_docente,$fecha){

        $a = DB::table('td_asign_docen')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->where('td_asign_docen.docente_id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('tipo_tarea.id','=','1')
        ->select(   

                    'td_asign_docen.*',
                )
        ->get();

        //dd($a);

        foreach ($a as $key => $value) {
            
            $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
            $td_asogn->estado = 0;
            $td_asogn->update();

        }

        Alert::success('¡Buen trabajo!', 'Se ha actualizado la anotación correctamente.')->autoClose(15000);
        return redirect()->route('admin.anotaciones.index'); 

    }

    public function activar_anotacion_amon($id_docente,$fecha){

        $a = DB::table('td_asign_docen')
        ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
        ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
        ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
        ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
        ->where('td_asign_docen.docente_id','=',$id_docente)
        ->where('anotaciones.fecha','=',$fecha)
        ->where('tipo_tarea.id','=','1')
        ->select(   

                    'td_asign_docen.*',
                )
        ->get();

        //dd($a);

        foreach ($a as $key => $value) {
            
            $td_asogn = TareaDetalle_Asignatura_Docente::findOrFail($value->id);
            $td_asogn->estado = 1; 
            $td_asogn->update();

        }

        Alert::success('¡Buen trabajo!', 'Se ha actualizado la anotación correctamente.')->autoClose(15000);
        return redirect()->route('admin.anotaciones.index'); 

    }



    public function index(){

       // $rows = Asignatura::orderBy('id')->paginate();

        return view('admin.anotaciones.index');
    }

    public function create()
    {
        $cursos = Curso::all();
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();
        
        return view('admin.anotaciones.create', compact('cursos','asignaturas','docentes'));
    }

    public function create_por_curso()
    {
        
        $cursos = Curso::all();
        
        
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();

        $referencias = Referencia::all();
        
        return view('admin.anotaciones.create-por-curso', compact('cursos','asignaturas','docentes','referencias'));
    }

    public function eliminadas()
    {
        
        $cursos = Curso::all();
        
        
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();

        $referencias = Referencia::all();
        
        return view('admin.anotaciones.eliminadas', compact('cursos','asignaturas','docentes','referencias'));
    }

    public function store(Request $request)
    {

        
        //dd($request->all());

        

        $curso_id = $request['curso_id'];
        $asignatura = $request['asignatura'];
        $docente = $request['docente'];
        $tareas = $request['tareas'];
        $fecha = $request['fecha'];
        $referencia_id = $request['referencia_id'];
        $estado = $request['estado'];
        

        $anotacion = new Anotacion;
        $anotacion->fecha = $fecha; // ...
        $anotacion->referencia_id = $referencia_id; 
        $anotacion->save(); 

        for ($i=0; $i < count($asignatura); $i++) { 
            $td_a_d = new TareaDetalle_Asignatura_Docente;
            $td_a_d->asignatura_id = $asignatura[$i]; //7
            $td_a_d->docente_id = $docente[$i]; //26
            $td_a_d->anotacion_id = $anotacion->id; //1
            $td_a_d->curso_id = $curso_id; //1
            $td_a_d->estado = $estado; //1
            $td_a_d->save();

            for ($j=0; $j < count($tareas[$i]); $j++) {
            //dd($tareas[$i][$j]);
               $tarea_detalle = new TareaDetalle;  
               $tarea_detalle->tarea_id = $tareas[$i][$j]; // 4
               $tarea_detalle->td_asign_docen_id = $td_a_d->id; //1
               $tarea_detalle->save();  
            }

            
        }

        toast('La anotación se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.anotaciones.index');
    }

    public function edit( $id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        
        return view('admin.anotaciones.edit', [ 'row' => $asignaturas]);
    }

    public function update(Request $request, $id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->update($request->all());
        toast('La anotación se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.anotaciones.index');

    }

    public function destroy($id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->delete();
        toast('La anotación se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.anotaciones.index');

    }

    public function vaciar(){
        Schema::disableForeignKeyConstraints();
        $ventas = DB::table('td_asign_docen')->truncate();
        $ventas = DB::table('anotaciones')->truncate();
        $ventas = DB::table('tareas_detalle')->truncate();
        Schema::enableForeignKeyConstraints();

        Alert::success('¡Buen trabajo!', 'Se han vaciado las tablas correctamente')->autoClose(15000);
        return redirect()->route('admin.anotaciones.index');   
    }


    public function get_cursos_by_docente($id_docente){

        $cursos = DB::table('cursos_asignaturas_docentes')
            ->join('docentes','cursos_asignaturas_docentes.docente_id','=','docentes.id')
            ->join('cursos','cursos_asignaturas_docentes.curso_id','=','cursos.id')
            ->select('cursos.id','cursos.nivel','cursos.letra')
            ->where('docentes.id','=',$id_docente)
            ->get();
        
        return json_encode($cursos);
    }

    public function get_asignaturas_by_docente($id_docente){
        
        $asignaturas = DB::table('cursos_asignaturas_docentes')
            ->join('docentes','cursos_asignaturas_docentes.docente_id','=','docentes.id')
            ->join('asignaturas','cursos_asignaturas_docentes.asignatura_id','=','asignaturas.id')
            ->select('asignaturas.id','asignaturas.nombre')
            ->where('docentes.id','=',$id_docente)
            ->distinct()
            ->get();
        
        
        
        return json_encode($asignaturas);
    }

    public function get_tareas(){
        
        $tareas = DB::table('tarea')
            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
            ->select('tarea.id','tarea.slug_nombre','tipo_tarea.slug_nombre as slug_nombre_tipotarea')
            ->get();
        
        
        
        return json_encode($tareas);
    }

    // public function get_paralelos($id_curso){

    //     $get_paralelos = DB::table('cursos')
    //                 ->where('cursos.nivel','=',$id_curso)
    //                 ->select('cursos.letra')
    //                 ->distinct()
    //                 ->get();
        
    //     return json_encode($get_paralelos);
    // }

    public function get_asignatura_by_curso($curso){

        // $get_asignaturas = DB::table('cursos')
        //         ->join('asignaturas','cursos.asignatura_id','=','asignaturas.id')
        //         ->join('docentes','cursos.docente_id','=','docentes.id')
        //         ->where('cursos.id','=',$curso)
        //         ->where('cursos.letra','=',$paralelo)
        //         ->select('asignaturas.id as id_asignatura','asignaturas.nombre','docentes.id as id_docente','docentes.nombres','docentes.apellido_paterno','docentes.apellido_materno')
        //         ->get();

        $get_asignaturas = DB::table('cursos_asignaturas_docentes')
                ->join('asignaturas','cursos_asignaturas_docentes.asignatura_id','=','asignaturas.id')
                ->join('docentes','cursos_asignaturas_docentes.docente_id','=','docentes.id')
                ->join('cursos','cursos_asignaturas_docentes.curso_id','=','cursos.id')
                ->where('cursos.id','=',$curso)
                ->select('asignaturas.id as id_asignatura','asignaturas.nombre','docentes.id as id_docente','docentes.nombres','docentes.apellido_paterno','docentes.apellido_materno')
                ->get();
        
        

        return json_encode($get_asignaturas);
    }

    public function data_duplicated($curso_id , $fecha){

        $duplicated = DB::table('td_asign_docen')
            ->join('anotaciones','td_asign_docen.anotacion_id','=','anotaciones.id')
            ->join('tareas_detalle','tareas_detalle.td_asign_docen_id','=','td_asign_docen.id')
            ->join('tarea','tareas_detalle.tarea_id','=','tarea.id')
            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
            ->where('td_asign_docen.curso_id','=',$curso_id)
            ->where('anotaciones.fecha','=',$fecha)
            ->where('td_asign_docen.estado','=','1')
            ->select(   'td_asign_docen.id',
                        'td_asign_docen.asignatura_id',
                        'td_asign_docen.docente_id',
                        'tarea.tipo_tarea_id',
                        'tarea.id as tarea_id'
                    )
            ->get();

        //dd($duplicated);
        return $duplicated;

    }

    

}
