<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CursosImport;
use App\Imports\DocentesImport;
use App\Imports\AsignaturasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CursosTemplateExport;
use App\Exports\DocentesTemplateExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\AsignaturasTemplateExport;
use App\Exports\CursoAsignaturaDocenteExport;
use App\Imports\CursoAsignaturaDocenteImport;

class ImportadoresController extends Controller
{
    const PERMISSIONS = [
        'show' => 'admin-importadores-show',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['show']);
    }

    public function index_importador_asignaturas(){
        
        return view('admin.importadores.asignaturas.index');
    }

    public function template_excel_asignaturas(){
        return Excel::download(new AsignaturasTemplateExport, 'template-asignaturas.xlsx');
    }

    public function upload_excel_asignaturas(Request $request){

        

        if($request->file('file')){
            $file = $request->file('file');
            try {
                Excel::import(new AsignaturasImport, $file);
                Alert::success('¡Buen trabajo!', 'Se han importado las asignaturas exitosamente');
                return redirect('/importadores/asignaturas');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $failures) {
                $errores_validacion = [];

                foreach ($failures->failures() as $failures) {
                    foreach ($failures->errors() as $errors) {
                        array_push($errores_validacion, $errors);
                    }
                }
                
                Alert::error('¡Error al importar asignaturas!', $errores_validacion)->autoClose(15000);
                return redirect('/importadores/asignaturas');
            }

            
        }
        
    }

    public function index_importador_docentes(){
        return view('admin.importadores.docentes.index');
    }

    public function template_excel_docentes(){
        return Excel::download(new DocentesTemplateExport, 'template-docentes.xlsx');
    }
    public function upload_excel_docentes(Request $request){

        

        if($request->file('file')){
            $file = $request->file('file');
            try {
                Excel::import(new DocentesImport, $file);
                Alert::success('¡Buen trabajo!', 'Se han importado los docentes exitosamente');
                return redirect('/importadores/docentes');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $failures) {
                $errores_validacion = [];

                foreach ($failures->failures() as $failures) {
                    foreach ($failures->errors() as $errors) {
                        array_push($errores_validacion, $errors);
                    }
                }
                
                Alert::error('¡Error al importar docentes!', $errores_validacion)->autoClose(15000);
                return redirect('/importadores/docentes');
            }

            
        }
    }

    public function index_importador_cursos(){
        return view('admin.importadores.cursos.index');
    }

    public function template_excel_cursos(){
        return Excel::download(new CursosTemplateExport, 'template-cursos.xlsx');
    }
    public function upload_excel_cursos(Request $request){

        if($request->file('file')){
            $file = $request->file('file');
            try {
                Excel::import(new CursosImport, $file);
                Alert::success('¡Buen trabajo!', 'Se han importado los cursos exitosamente');
                return redirect('/importadores/cursos');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $failures) {
                $errores_validacion = [];

                foreach ($failures->failures() as $failures) {
                    foreach ($failures->errors() as $errors) {
                        array_push($errores_validacion, $errors);
                    }
                }
                
                Alert::error('¡Error al importar cursos!', $errores_validacion)->autoClose(15000);
                return redirect('/importadores/cursos');
            }

            
        }
    }

    public function index_curso_x_asignatura_x_docente(){
        return view('admin.importadores.curso_x_asignatura_x_docente.index');
    }

    public function template_excel_curso_x_asignatura_x_docente(){
        return Excel::download(new CursoAsignaturaDocenteExport, 'template-curso-x-asignatura-x-docente.xlsx');
    }
    public function upload_excel_curso_x_asignatura_x_docente(Request $request){

        if($request->file('file')){
            $file = $request->file('file');
            try {
                Excel::import(new CursoAsignaturaDocenteImport, $file);
                Alert::success('¡Buen trabajo!', 'Se han importado los curso-x-asignatura-x-docente exitosamente');
                return redirect('/importadores/cursos');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $failures) {
                $errores_validacion = [];

                foreach ($failures->failures() as $failures) {
                    foreach ($failures->errors() as $errors) {
                        array_push($errores_validacion, $errors);
                    }
                }
                
                Alert::error('¡Error al importar curso-x-asignatura-x-docente!', $errores_validacion)->autoClose(15000);
                return redirect('/importadores/curso-x-asignatura-x-docente');
            }

            
        }
    }
}
