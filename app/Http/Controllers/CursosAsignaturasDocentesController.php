<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Asignatura;
use Illuminate\Http\Request;
use App\CursoAsignaturaDocente;
use Illuminate\Support\Facades\DB;

class CursosAsignaturasDocentesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-cursos-x-asignaturas-x-docentes-create',
        'show' => 'admin-cursos-x-asignaturas-x-docentes-show',
        'edit' => 'admin-cursos-x-asignaturas-x-docentes-edit',
        'delete' => 'admin-cursos-x-asignaturas-x-docentes-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_todo(){
        
        $cursos = DB::table('cursos_asignaturas_docentes')
            ->join('docentes','cursos_asignaturas_docentes.docente_id','=','docentes.id')
            ->join('asignaturas','cursos_asignaturas_docentes.asignatura_id','=','asignaturas.id')
            ->join('cursos','cursos_asignaturas_docentes.curso_id','=','cursos.id')
            ->select('cursos_asignaturas_docentes.id','cursos.nivel','cursos.letra','asignaturas.nombre as nombre_asignatura','docentes.nombres','docentes.apellido_paterno','docentes.apellido_materno')
            ->get();
        
        //dd($cursos);

        $data = [];
        $results = [];

        
        foreach($cursos as $curso){
            $row[0]=$curso->id;
            $row[1]=$curso->nivel;
            $row[2]=$curso->letra;
            $row[3]=$curso->nombre_asignatura;
            $row[4]=$curso->nombres;
            $row[5]=$curso->apellido_paterno;
            $row[6]=$curso->apellido_materno;
            $row[7]='<div class="btn-group btn-group-sm">
                    <a href="/curso_x_asignatura_x_docente/'.$curso->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$curso->id.'><i class="bi bi-x-lg"></i></a>
                    </div> 
                    ';
            $data[]=$row;
        }

        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);
    }

    public function index(){

       // $rows = Asignatura::orderBy('id')->paginate();

        return view('admin.curso_x_asignatura_x_docente.index');
    }

    public function create()
    {
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();
        $cursos = Curso::all();

        return view('admin.curso_x_asignatura_x_docente.create' , compact('asignaturas','docentes','cursos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'curso_id' => 'required',
            'docente_id' => 'required',
            'asignatura_id' => 'required',

        ]);
           
        //dd($request->all());

        $row = new CursoAsignaturaDocente;
        $row->curso_id = $request->get('curso_id');
        $row->docente_id = $request->get('docente_id');
        $row->asignatura_id = $request->get('asignatura_id');




        $row->save();

        toast('El cursos-x-asignaturas-x-docentes se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.curso_x_asignatura_x_docente.index');
    }

    public function edit( $id)
    {
        $row = CursoAsignaturaDocente::findOrFail($id);
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();
        $cursos = Curso::all();

        
        return view('admin.curso_x_asignatura_x_docente.edit', compact('row','asignaturas','docentes','cursos'));
    }

    public function update(Request $request, $id)
    {
        $cursos = CursoAsignaturaDocente::findOrFail($id);
        $cursos->update($request->all());
        toast('El cursos-x-asignaturas-x-docentes se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.curso_x_asignatura_x_docente.index');

    }

    public function destroy($id)
    {
        $cursos = CursoAsignaturaDocente::findOrFail($id);
        $cursos->delete();
        toast('El cursos-x-asignaturas-x-docentes se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.curso_x_asignatura_x_docente.index');

    }




   
}