<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Docente;
use App\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-cursos-create',
        'show' => 'admin-cursos-show',
        'edit' => 'admin-cursos-edit',
        'delete' => 'admin-cursos-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_cursos(){
        
        $cursos = DB::table('cursos')
            ->select('cursos.id','cursos.nivel','cursos.letra')
            ->get();
        
        //dd($cursos);

        $data = [];
        $results = [];

        
        foreach($cursos as $curso){
            $row[0]=$curso->id;
            $row[1]=$curso->nivel;
            $row[2]=$curso->letra;
            $row[3]='<div class="btn-group btn-group-sm">
                    <a href="/cursos/'.$curso->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
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

        return view('admin.cursos.index');
    }

    public function create()
    {


        return view('admin.cursos.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nivel' => 'required',
            'letra' => 'required',

        ]);
           
        //dd($request->all());

        $row = new Curso;
        $row->nivel = $request->get('nivel');
        $row->letra = $request->get('letra');




        $row->save();

        toast('El curso se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cursos.index');
    }

    public function edit( $id)
    {
        $row = Curso::findOrFail($id);

        
        return view('admin.cursos.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $cursos = Curso::findOrFail($id);
        $cursos->update($request->all());
        toast('El curso se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cursos.index');

    }

    public function destroy($id)
    {
        $cursos = Curso::findOrFail($id);
        $cursos->delete();
        toast('El curso se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cursos.index');

    }




    // public function GetDataCurso (){
        
    //     $d = Curso::with('docente', 'asignatura')->get();
    //     $doc = Docente::get();
      
    //     $asig = Asignatura::first();
    //    // $x =  collect($d)->groupBy('docente_id');
        
    //     $ar = [];

    //     $xd = $doc->map(function($doc) use($d){
            
    //         foreach ($d as $k => $v) {
    //             return [
    //                 'docente' => $doc->nombres. ','. $doc->apellido_paterno.','. $doc->apellido_materno,
    //                 'curso' => $v->nivel.''.$v->letra,
    //                 'materias' => $this->getMaterias($v, $doc->id),
    //              ];
    //         }
            
    //     });
    //     dd($xd);
    // }

    // public function getMaterias($v, $iddoc){
           
    // }

}

