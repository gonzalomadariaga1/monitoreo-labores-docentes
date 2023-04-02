<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\TipoTareaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\AnotacionesController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\ImportadoresController;
use App\Http\Controllers\CursosAsignaturasDocentesController;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /**
         * Admin / Users
         * 
         */
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['create']],[
            'description' => 'Creación de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']],[
            'description' => 'Listado y detalle de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']],[
            'description' => 'Edición de usuarios'
        ]);

        /**
         * Admin / Permission
         */

        Permission::updateOrCreate(['name' => PermissionController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de permisos'
        ]);

        /**
         * Admin / Role
         */
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['create']], [
            'description' => 'Creación de roles'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de roles'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['edit']], [
            'description' => 'Edición de rol'
        ]);
        Permission::updateOrCreate(['name' => RoleController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de roles'
        ]);

        /**
         * Admin / Mantenedores / Asignaturas
         */
        Permission::updateOrCreate(['name' => AsignaturasController::PERMISSIONS['create']], [
            'description' => 'Creación de asignatura'
        ]);
        Permission::updateOrCreate(['name' => AsignaturasController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de asignatura'
        ]);
        Permission::updateOrCreate(['name' => AsignaturasController::PERMISSIONS['edit']], [
            'description' => 'Edición de asignatura'
        ]);
        Permission::updateOrCreate(['name' => AsignaturasController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de asignatura'
        ]);

        /**
         * Admin / Mantenedores / Docente
         */
        Permission::updateOrCreate(['name' => DocentesController::PERMISSIONS['create']], [
            'description' => 'Creación de docente'
        ]);
        Permission::updateOrCreate(['name' => DocentesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de docente'
        ]);
        Permission::updateOrCreate(['name' => DocentesController::PERMISSIONS['edit']], [
            'description' => 'Edición de docente'
        ]);
        Permission::updateOrCreate(['name' => DocentesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de docente'
        ]);

        /**
         * Admin / Mantenedores / Cursos
         */
        Permission::updateOrCreate(['name' => CursosController::PERMISSIONS['create']], [
            'description' => 'Creación de curso'
        ]);
        Permission::updateOrCreate(['name' => CursosController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de curso'
        ]);
        Permission::updateOrCreate(['name' => CursosController::PERMISSIONS['edit']], [
            'description' => 'Edición de curso'
        ]);
        Permission::updateOrCreate(['name' => CursosController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de curso'
        ]);


         /**
         * Admin / Mantenedores / CursosAsignaturaDocente
         */
        Permission::updateOrCreate(['name' => CursosAsignaturasDocentesController::PERMISSIONS['create']], [
            'description' => 'Creación de CursosAsignaturaDocente'
        ]);
        Permission::updateOrCreate(['name' => CursosAsignaturasDocentesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de CursosAsignaturaDocente'
        ]);
        Permission::updateOrCreate(['name' => CursosAsignaturasDocentesController::PERMISSIONS['edit']], [
            'description' => 'Edición de CursosAsignaturaDocente'
        ]);
        Permission::updateOrCreate(['name' => CursosAsignaturasDocentesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de CursosAsignaturaDocente'
        ]);


         /**
         * Admin / Mantenedores / Anotaciones
         */
        Permission::updateOrCreate(['name' => AnotacionesController::PERMISSIONS['create']], [
            'description' => 'Creación de anotación'
        ]);
        Permission::updateOrCreate(['name' => AnotacionesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de anotación'
        ]);
        Permission::updateOrCreate(['name' => AnotacionesController::PERMISSIONS['edit']], [
            'description' => 'Edición de anotación'
        ]);
        Permission::updateOrCreate(['name' => AnotacionesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de anotación'
        ]);


        /**
         * Admin / Mantenedores / Tarea
         */
        Permission::updateOrCreate(['name' => TareaController::PERMISSIONS['create']], [
            'description' => 'Creación de tarea'
        ]);
        Permission::updateOrCreate(['name' => TareaController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de tarea'
        ]);
        Permission::updateOrCreate(['name' => TareaController::PERMISSIONS['edit']], [
            'description' => 'Edición de tarea'
        ]);
        Permission::updateOrCreate(['name' => TareaController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de tarea'
        ]);

        /**
         * Admin / Mantenedores / Tipo Tarea
         */
        Permission::updateOrCreate(['name' => TipoTareaController::PERMISSIONS['create']], [
            'description' => 'Creación de tipo de tarea'
        ]);
        Permission::updateOrCreate(['name' => TipoTareaController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de tipo de tarea'
        ]);
        Permission::updateOrCreate(['name' => TipoTareaController::PERMISSIONS['edit']], [
            'description' => 'Edición de tipo de tarea'
        ]);
        Permission::updateOrCreate(['name' => TipoTareaController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de tipo de tarea'
        ]);

        /**
         * Admin / Mantenedores / Referencia
         */
        Permission::updateOrCreate(['name' => ReferenciaController::PERMISSIONS['create']], [
            'description' => 'Creación de referencia'
        ]);
        Permission::updateOrCreate(['name' => ReferenciaController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de referencia'
        ]);
        Permission::updateOrCreate(['name' => ReferenciaController::PERMISSIONS['edit']], [
            'description' => 'Edición de referencia'
        ]);
        Permission::updateOrCreate(['name' => ReferenciaController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de referencia'
        ]);

        /**
         * Admin / Mantenedores / Importadores
         */
        
        Permission::updateOrCreate(['name' => ImportadoresController::PERMISSIONS['show']], [
            'description' => 'Permite importar mediante archivos Excel'
        ]);
        
    }
}
