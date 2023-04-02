<?php

namespace App\Http\Controllers;

use App\TipoTarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoTareaController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-tipotarea-create',
        'show' => 'admin-tipotarea-show',
        'edit' => 'admin-tipotarea-edit',
        'delete' => 'admin-tipotarea-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_tipotarea(){
        
        $tipotarea = DB::table('tipo_tarea')
                        ->select('tipo_tarea.id','tipo_tarea.nombre','tipo_tarea.slug_nombre')
                        ->orderby('id','desc')
                        ->get();

        $data = [];
        $results = [];

        
        foreach($tipotarea as $tp){
            $row[0]=$tp->id;
            $row[1]=$tp->nombre;
            $row[2]=$tp->slug_nombre;
            $row[3]='<div class="btn-group btn-group-sm">
                    <a href="/tipotarea/'.$tp->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$tp->id.'><i class="bi bi-x-lg"></i></a>
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

       // $rows = TipoTarea::orderBy('id')->paginate();

        return view('admin.tipotarea.index');
    }

    public function create()
    {
        
        return view('admin.tipotarea.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'slug_nombre' => 'required'
        ]);
           
        //dd($request->all());

        $row = new TipoTarea;
        $row->nombre = $request->get('nombre');
        $row->slug_nombre = $request->get('slug_nombre');



        $row->save();

        toast('El tipo de tarea se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tipotarea.index');
    }

    public function edit( $id)
    {
        $tipotarea = TipoTarea::findOrFail($id);
        
        return view('admin.tipotarea.edit', [ 'row' => $tipotarea]);
    }

    public function update(Request $request, $id)
    {
        $tipotarea = TipoTarea::findOrFail($id);
        $tipotarea->update($request->all());
        toast('El tipo de tarea se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tipotarea.index');

    }

    public function destroy($id)
    {
        $tipotarea = TipoTarea::findOrFail($id);
        $tipotarea->delete();
        toast('El tipo de tarea se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tipotarea.index');

    }
}

