<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-user-create',
        'show' => 'admin-user-show',
        'edit' => 'admin-user-edit',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        
        // $this->middleware('permission:'.self::PERMISSIONS['assign-roles'])->only(['role']);
        // $this->middleware('permission:'.self::PERMISSIONS['assign-permissions'])->only(['permission']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();

        return view('admin.users.index' , ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);
        //$verrespuesta = $request->all();
        //dd($verrespuesta);

        $usuarios = new User;

        $usuarios->name = $request->get('name');
        $usuarios->email = $request->get('email');
        $usuarios->password = Hash::make($request->password);

               
        $usuarios->save();

        toast('El usuario se ha creado correctamente.','success')->timerProgressBar();
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', [
            'user' => $user->load('roles','permissions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = User::findOrFail($id);
        
        return view("admin.users.edit",[
            "usuarios"=>$usuarios,
            'roles' => Role::orderBy('id')->get(),
        ]);
    }

    public function edit_permission($id)
    {
        $usuarios = User::findOrFail($id);
        return view("admin.users.edit_permiso",[
            "usuarios"=>$usuarios,
            'roles' => Role::orderBy('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());

        $usuarios = User::findOrFail($id);

        $usuarios->name = $request->get('name');
        $usuarios->email = $request->get('email');
        $usuarios->password = Hash::make($request->password);

        $usuarios->update();
        $usuarios->roles()->sync($request->get('permiso'));

        toast('El usuario se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect('/users');
    }

    public function update_permiso(Request $request, $id)
    {
        $usuarios = User::findOrFail($id);
        $usuarios->roles()->sync($request->get('permiso'));
        toast('El usuario se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        toast('El usuario se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect('/users');
    }
}
