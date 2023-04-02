@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
    @include('admin.importadores.cursos.header',['title' => 'Importador de cursos'])

    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                  <h4>Importadores para cursos</h4>
              </div>
              
            </div>
          </div>
  
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                  <h5> Antes de continuar, tenga en cuenta las siguientes instrucciones:</h5>
                  <span>La columna <strong>Nivel</strong> es obligatoria y corresponde al nivel del curso. Ejemplo: 1°  </span>
                  <br>
                  <span>La columna <strong>Letra</strong> es obligatoria y corresponde a la letra del curso. Ejemplo: A  </span>
                  {{-- <br>
                  <span>La columna <strong>Docente_id</strong> es obligatoria y solo acepta números. Corresponde al ID del docente. El ID de cada docente se puede visualizar en la sección Docentes. </span>
                  <br>
                  <span>La columna <strong>Asignatura_id</strong> es obligatoria y solo acepta números. Corresponde al ID de la asignatura. El ID de cada asignatura se puede visualizar en la sección Asignaturas. </span>
                  <br> --}}
                  
                  <br>
                  <span> <strong>Importante:</strong> El archivo a importar debe tener un formato que ya está predefinido. Ese formato lo puede descargar presionando el botón <strong>Descargar Template.</strong></span>
              </div>
            </div>

            <div class="row">
              <form action="{{route('admin.importadores.upload_cursos')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <br>
                <input type="file" name="file" id="file" required class="mb-4">
                
            </div>

            
            
            

          </div>

          
          <div class="card-footer">
            <div class="d-flex justify-content-start">
              <a name="" id="" class="btn btn-warning me-3 " href="{{route('admin.importadores.template_cursos')}}" role="button">Descargar template</a>
              <button type="submit" class="btn btn-primary ">Importar</button>
            </div>

            
          </div>
              
            </form>

          
  
      
      
          
        </div>
      </div>
      
    
      
      
  </div>

    @include('includes.modal-delete')
  </main>
@endsection