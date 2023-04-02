<?php

namespace App\Http\Controllers;

use App\Docente;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\DB;

class DocentesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-docentes-create',
        'show' => 'admin-docentes-show',
        'edit' => 'admin-docentes-edit',
        'delete' => 'admin-docentes-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_docentes(){
        
        $docentes = DB::table('docentes')
                        ->select('docentes.id','docentes.nombres' ,'docentes.apellido_paterno' ,'docentes.apellido_materno' ,'docentes.rut')
                        ->orderby('id','desc')
                        ->get();

        $data = [];
        $results = [];

        
        foreach($docentes as $docente){
            $row[0]=$docente->id;
            $row[1]=$docente->rut;
            $row[2]=$docente->nombres;
            $row[3]=$docente->apellido_paterno;
            $row[4]=$docente->apellido_materno;
            $row[5]='<div class="btn-group btn-group-sm">
                    <a href="/docentes/'.$docente->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$docente->id.'><i class="bi bi-x-lg"></i></a>
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

        //$rows = Docente::orderBy('id')->paginate();

        return view('admin.docentes.index');
    }

    public function create()
    {
        
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'rut'=> 'required|cl_rut'
        ]);
           
        //dd($request->all());

        $row = new Docente;
        
        $rut = Rut::parse($request->get('rut'))->normalize();

        $row->rut = $rut;

        $row->nombres = $request->get('nombres');
        $row->apellido_paterno = $request->get('apellido_paterno');
        $row->apellido_materno = $request->get('apellido_materno');

        $row->save();

        toast('El docente se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.docentes.index');
    }

    public function edit( $id)
    {
        $docentes = Docente::findOrFail($id);
        
        return view('admin.docentes.edit', [ 'row' => $docentes]);
    }

    public function update(Request $request, $id)
    {
        $docentes = Docente::findOrFail($id);
        $docentes->update($request->all());
        toast('El docente se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.docentes.index');

    }

    public function destroy($id)
    {
        $docentes = Docente::findOrFail($id);
        $docentes->delete();
        toast('El docente se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.docentes.index');

    }
}