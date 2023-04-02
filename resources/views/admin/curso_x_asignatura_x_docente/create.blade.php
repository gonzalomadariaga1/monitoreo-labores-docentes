@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.curso_x_asignatura_x_docente.headersection',['title' => 'Crear CxAxD'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('CursosAsignaturasDocentesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de CxAxD</div>
              <div class="card-body">
                <br>

                  <div class="row">

                    

                    <div class="col-lg-4 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Curso </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row mt-2">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                  <select class="selectpicker curso_id"  title="Seleccione curso..." data-live-search="true"  data-width="100%" name="curso_id" id="curso_id" >
                                    <option value="0" disabled selected>Seleccione curso...</option>
                                    @foreach ($cursos as $curso)
                                        
                                        <option value="{{ $curso->id }}" > 
                                          {{$curso->nivel}} {{$curso->letra}}</option>
                                    @endforeach
                                  </select>  
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>

                    <div class="col-lg-4 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Asignatura </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row mt-2">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                  <select class="selectpicker asignatura_id"  title="Seleccione asignatura..." data-live-search="true"  data-width="100%" name="asignatura_id" id="asignatura_id" >
                                    <option value="0" disabled selected>Seleccione asignatura...</option>
                                    @foreach ($asignaturas as $asignatura)
                                        
                                        <option value="{{ $asignatura->id }}" > 
                                          {{$asignatura->nombre}} </option>
                                    @endforeach
                                  </select>  
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>

                    <div class="col-lg-4 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Docente</h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row mt-2">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                  <select class="selectpicker docente_id"  title="Seleccione docente..." data-live-search="true"  data-width="auto" name="docente_id" id="docente_id" >
                                    <option value="0" disabled selected>Seleccione docente...</option>
                                    @foreach ($docentes as $docente)
                                        
                                        <option value="{{ $docente->id }}" > 
                                          {{$docente->nombres}} {{$docente->apellido_paterno}}  {{$docente->apellido_materno}}</option>
                                    @endforeach
                                  </select>  
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>

                  </div>
              </div>
                  
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>
  </main>
@endsection

@section('code_js')
<script>
  $(document).ready(function() {
      $('.docente_id').selectpicker();
      $('.asignatura_id').selectpicker();
      $('.curso_id').selectpicker();
    });
</script>
@endsection


