<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\TipoTarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-tarea-create',
        'show' => 'admin-tarea-show',
        'edit' => 'admin-tarea-edit',
        'delete' => 'admin-tarea-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_tarea(){
        
        $tarea = DB::table('tarea')
            ->join('tipo_tarea','tarea.tipo_tarea_id','=','tipo_tarea.id')
            ->select('tarea.id','tarea.nombre', 'tarea.slug_nombre' , 'tipo_tarea.nombre as nombre_tipotarea' , 'tipo_tarea.slug_nombre as slug_nombre_tipotarea')
            ->orderby('id','desc')
            ->get();

        //dd($tarea);

        $data = [];
        $results = [];

        
        foreach($tarea as $t){
            $row[0]=$t->id;
            $row[1]=$t->nombre;
            $row[2]=$t->slug_nombre;
            $row[3]=$t->nombre_tipotarea;
            $row[4]=$t->slug_nombre_tipotarea;
            $row[5]='<div class="btn-group btn-group-sm">
                    <a href="/tarea/'.$t->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$t->id.'><i class="bi bi-x-lg"></i></a>
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

       // $rows = Tarea::orderBy('id')->paginate();

        return view('admin.tarea.index');
    }

    public function create()
    {
        $tipotarea = TipoTarea::all();
        return view('admin.tarea.create' , compact('tipotarea') );
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'slug_nombre' => 'required',
            'tipo_tarea_id' => 'required',
        ]);
           
        //dd($request->all());

        $row = new Tarea;
        $row->nombre = $request->get('nombre');
        $row->slug_nombre = $request->get('slug_nombre');
        $row->tipo_tarea_id = $request->get('tipo_tarea_id');



        $row->save();

        toast('La tarea se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tarea.index');
    }

    public function edit( $id)
    {
        $row = Tarea::findOrFail($id);
        $tipotarea = TipoTarea::all();

        return view('admin.tarea.edit', compact('row','tipotarea') );
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        toast('La tarea se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tarea.index');

    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        toast('La tarea se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.tarea.index');

    }
}
