<?php

namespace App\Http\Controllers;

use App\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferenciaController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-referencia-create',
        'show' => 'admin-referencia-show',
        'edit' => 'admin-referencia-edit',
        'delete' => 'admin-referencia-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function get_referencia(){
        
        $referencias = DB::table('referencia')
                        ->select('referencia.id','referencia.nombre')
                        ->orderby('id','desc')
                        ->get();

        $data = [];
        $results = [];

        
        foreach($referencias as $referencias){
            $row[0]=$referencias->id;
            $row[1]=$referencias->nombre;
            $row[2]='<div class="btn-group btn-group-sm">
                    <a href="/referencia/'.$referencias->id.'/edit" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$referencias->id.'><i class="bi bi-x-lg"></i></a>
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

       // $rows = Referencia::orderBy('id')->paginate();

        return view('admin.referencia.index');
    }

    public function create()
    {
        
        return view('admin.referencia.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required'
        ]);
           
        //dd($request->all());

        $row = new Referencia;
        $row->nombre = $request->get('nombre');



        $row->save();

        toast('La referencia se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.referencia.index');
    }

    public function edit( $id)
    {
        $referencias = Referencia::findOrFail($id);
        
        return view('admin.referencia.edit', [ 'row' => $referencias]);
    }

    public function update(Request $request, $id)
    {
        $referencias = Referencia::findOrFail($id);
        $referencias->update($request->all());
        toast('La referencia se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.referencia.index');

    }

    public function destroy($id)
    {
        $referencias = Referencia::findOrFail($id);
        $referencias->delete();
        toast('La referencia se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.referencia.index');

    }
}

