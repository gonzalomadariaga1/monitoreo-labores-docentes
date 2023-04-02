<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    const PERMISSIONS = [
        'show' => 'admin-permission-show',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['show']);
    }

    public function index()
    {
        $permission = Permission::orderBy('name')->paginate();

        return view('admin.permission.index', [
            'rows' => $permission
        ]);
    }

    public function show(Permission $permission)
    {
        return view('admin.permission.show', [
            'row' => $permission->load('users', 'roles')
        ]);
    }
}
