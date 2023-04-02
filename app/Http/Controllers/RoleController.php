<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    const PERMISSIONS = [
        'create' => 'admin-role-create',
        'show' => 'admin-role-show',
        'edit' => 'admin-role-edit',
        'delete' => 'admin-role-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Role::orderBy('name')->paginate();

        return view('admin.role.index', [
            'rows' => $rows,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create', [
            'row' => new Role(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $row = new Role;
        $row->name = $request->get('name');
        $row->description = $request->get('description');
       
        $get_permiso = $request->get('permiso');

        if( is_null($get_permiso) == true){
            Alert::error('¡Hey, detente!', 'No es posible crear un rol sin permisos');
            return redirect()->route('admin.role.create');
        }else{

            
            $row->save();
            $row->permissions()->sync($request->get('permiso'));

            toast('El rol se ha creado correctamente.','success')->timerProgressBar();
            return redirect()->route('admin.role.index');

        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.role.show', [
            'row' => $role->load('permissions'),
            'row_user' => $role->load('users')
        ]);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'row' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //dd($request->all());
        $get_permiso = $request->get('permiso');
        

        if( is_null($get_permiso) == true){
            Alert::error('¡Hey, detente!', 'No es posible crear un rol sin permisos');
            return redirect()->route('admin.role.edit',$role->id);
        }else{

            
            $role->update($request->all());
            $role->permissions()->sync($request->get('permiso'));

            toast('El rol se ha actualizado correctamente.','success')->timerProgressBar();
            return redirect()->route('admin.role.index');
        }

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        toast('El rol se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.role.index');
    }
}
