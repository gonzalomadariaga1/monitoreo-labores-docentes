<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('home');

Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return Redirect::to('/');
})->name('logout');

Auth::routes();

// Auth::routes(["register" => false]);

Route::group(['middleware' => 'auth'], function () {  

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users/{id}/edit_permiso', 'UsersController@edit_permission')->name('admin.users.edit_permission');
        
    Route::patch('/users/{id}/update_permiso', 'UsersController@update_permiso')->name('admin.users.update_permission');

    Route::resource('users', 'UsersController')->names('admin.users');

    Route::resource('permisos', 'PermissionController')->names('admin.permission')->parameters(['permisos' => 'permission'])->only(['index','show']);

    Route::resource('roles', 'RoleController')->names('admin.role')->parameters(['permisos' => 'role']);

    Route::get('/importadores/asignaturas', 'ImportadoresController@index_importador_asignaturas')->name('admin.importadores.asignaturas');
    Route::get('/template/asignaturas','ImportadoresController@template_excel_asignaturas')->name('admin.importadores.template_asignaturas');
    Route::post('/upload/asignaturas','ImportadoresController@upload_excel_asignaturas')->name('admin.importadores.upload_asignaturas');

    Route::get('/importadores/docentes', 'ImportadoresController@index_importador_docentes')->name('admin.importadores.docentes');
    Route::get('/template/docentes','ImportadoresController@template_excel_docentes')->name('admin.importadores.template_docentes');
    Route::post('/upload/docentes','ImportadoresController@upload_excel_docentes')->name('admin.importadores.upload_docentes');

    Route::get('/importadores/cursos', 'ImportadoresController@index_importador_cursos')->name('admin.importadores.cursos');
    Route::get('/template/cursos','ImportadoresController@template_excel_cursos')->name('admin.importadores.template_cursos');
    Route::post('/upload/cursos','ImportadoresController@upload_excel_cursos')->name('admin.importadores.upload_cursos');

    Route::get('/importadores/curso-x-asignatura-x-docente', 'ImportadoresController@index_curso_x_asignatura_x_docente')->name('admin.importadores.curso_x_asignatura_x_docente');
    Route::get('/template/curso-x-asignatura-x-docente','ImportadoresController@template_excel_curso_x_asignatura_x_docente')->name('admin.importadores.template_curso_x_asignatura_x_docente');
    Route::post('/upload/curso-x-asignatura-x-docente','ImportadoresController@upload_excel_curso_x_asignatura_x_docente')->name('admin.importadores.upload_curso_x_asignatura_x_docente');

    Route::get('/asignaturas/get_asignaturas','AsignaturasController@get_asignaturas')->name('admin.asignaturas.get_asignaturas');
    Route::resource('asignaturas', 'AsignaturasController')->names('admin.asignaturas');

    Route::get('/docentes/get_docentes','DocentesController@get_docentes')->name('admin.docentes.get_docentes');
    Route::resource('docentes', 'DocentesController')->names('admin.docentes');

    Route::get('/cursos/get_cursos','CursosController@get_cursos')->name('admin.cursos.get_cursos');
    Route::resource('cursos', 'CursosController')->names('admin.cursos');

    Route::get('/curso_x_asignatura_x_docente/get_todo','CursosAsignaturasDocentesController@get_todo')->name('admin.curso_x_asignatura_x_docente.get_todo');
    Route::resource('curso_x_asignatura_x_docente', 'CursosAsignaturasDocentesController')->names('admin.curso_x_asignatura_x_docente');

    Route::get('/referencia/get_referencia','ReferenciaController@get_referencia')->name('admin.referencia.get_asignaturas');
    Route::resource('referencia', 'ReferenciaController')->names('admin.referencia');

    Route::get('/anotaciones/{id_docente}/get_cursos','AnotacionesController@get_cursos_by_docente')->name('admin.anotaciones.get_cursos_by_docente');
    Route::get('/anotaciones/{id_docente}/get_asignaturas','AnotacionesController@get_asignaturas_by_docente')->name('admin.anotaciones.get_asignaturas_by_docente');
    Route::get('/anotaciones/{id_curso}/get_paralelos','AnotacionesController@get_paralelos')->name('admin.anotaciones.get_paralelos');
    Route::get('/anotaciones/get_tareas','AnotacionesController@get_tareas')->name('admin.anotaciones.get_tareas');

    Route::get('/anotaciones/get_anotaciones_tipo_amonestacion_groupby_docente','AnotacionesController@get_anotaciones_tipo_amonestacion_groupby_docente')->name('admin.anotaciones.get_anotaciones_tipo_amonestacion_groupby_docente');
    Route::get('/anotaciones/get_anotaciones_tipo_memo_groupby_docente','AnotacionesController@get_anotaciones_tipo_memo_groupby_docente')->name('admin.anotaciones.get_anotaciones_tipo_memo_groupby_docente');
    Route::get('/anotaciones/get_anotaciones_amon_eliminadas','AnotacionesController@get_anotaciones_amon_eliminadas')->name('admin.anotaciones.get_anotaciones_amon_eliminadas');
    Route::get('/anotaciones/get_anotaciones_memo_eliminadas','AnotacionesController@get_anotaciones_memo_eliminadas')->name('admin.anotaciones.get_anotaciones_memo_eliminadas');
    
    Route::get('/anotaciones/{curso}/get_asignaturas_by_curso','AnotacionesController@get_asignatura_by_curso')->name('admin.anotaciones.get_asignatura_by_curso');

    Route::get('/anotaciones/create-por-curso','AnotacionesController@create_por_curso')->name('admin.anotaciones.create2');

    Route::get('/anotaciones/eliminadas','AnotacionesController@eliminadas')->name('admin.anotaciones.eliminadas');

    Route::get('/anotaciones/vaciar','AnotacionesController@vaciar')->name('admin.anotaciones.vaciar');

    Route::get('/anotaciones/{docente_id}/{fecha}/show_more_data_memo','AnotacionesController@show_more_data_memo')->name('admin.anotaciones.show_more_data_memo');
    Route::get('/anotaciones/{docente_id}/{fecha}/show_more_data_amon','AnotacionesController@show_more_data_amon')->name('admin.anotaciones.show_more_data_amon');
    
    Route::get('/anotaciones/{docente_id}/{fecha}/borrar_anotacion','AnotacionesController@borrar_anotacion')->name('admin.anotaciones.borrar_anotacion');

    Route::get('/anotaciones/{docente_id}/{fecha}/anular_anotacion_memo','AnotacionesController@anular_anotacion_memo')->name('admin.anotaciones.anular_anotacion_memo');
    Route::get('/anotaciones/{docente_id}/{fecha}/activar_anotacion_memo','AnotacionesController@activar_anotacion_memo')->name('admin.anotaciones.activar_anotacion_memo');

    Route::get('/anotaciones/{docente_id}/{fecha}/anular_anotacion_amon','AnotacionesController@anular_anotacion_amon')->name('admin.anotaciones.anular_anotacion_amon');
    Route::get('/anotaciones/{docente_id}/{fecha}/activar_anotacion_amon','AnotacionesController@activar_anotacion_amon')->name('admin.anotaciones.activar_anotacion_amon');

    Route::get('/anotaciones/{curso_id}/{fecha}/data_duplicated','AnotacionesController@data_duplicated')->name('admin.anotaciones.data_duplicated');




     Route::resource('anotaciones', 'AnotacionesController')->names('admin.anotaciones');

    Route::get('/tipotarea/get_tipotarea','TipoTareaController@get_tipotarea')->name('admin.tipotarea.get_tipotarea');
    Route::resource('tipotarea', 'TipoTareaController')->names('admin.tipotarea');

    Route::get('/tarea/get_tarea','TareaController@get_tarea')->name('admin.tarea.get_tarea');
    Route::resource('tarea', 'TareaController')->names('admin.tarea');

    Route::get('/pdf/{id_docente}/{correlativo}/{fecha}/memo','PdfController@downloadPDFMemo');
    Route::get('/pdf/{id_docente}/{correlativo}/{fecha}/amon','PdfController@downloadPDFAmon');
    
});
