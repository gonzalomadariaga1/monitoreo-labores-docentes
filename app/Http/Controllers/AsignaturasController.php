<?php

namespace App\Http\Controllers;

use App\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignaturasController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-asignaturas-create',
        'show' => 'admin-asignaturas-show',
        'edit' => 'admin-asignaturas-edit',
        'delete' => 'admin-asignaturas-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_asignaturas(){
        
        $asignaturas = DB::table('asignaturas')
                        ->select('asignaturas.id','asignaturas.nombre')
                        ->orderby('id','desc')
                        ->get();

        $data = [];
        $results = [];

        
        foreach($asignaturas as $asignatura){
            $row[0]=$asignatura->id;
            $row[1]=$asignatura->nombre;
            $row[2]='<div class="btn-group btn-group-sm">
                    <a href="/asignaturas/'.$asignatura->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$asignatura->id.'><i class="bi bi-x-lg"></i></a>
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

        return view('admin.asignaturas.index');
    }

    public function create()
    {
        
        return view('admin.asignaturas.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required'
        ]);
           
        //dd($request->all());

        $row = new Asignatura;
        $row->nombre = $request->get('nombre');



        $row->save();

        toast('La asignatura se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.asignaturas.index');
    }

    public function edit( $id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        
        return view('admin.asignaturas.edit', [ 'row' => $asignaturas]);
    }

    public function update(Request $request, $id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->update($request->all());
        toast('La asignatura se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.asignaturas.index');

    }

    public function destroy($id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->delete();
        toast('La asignatura se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.asignaturas.index');

    }
}
