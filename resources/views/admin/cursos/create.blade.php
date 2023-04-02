@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.cursos.headersection',['title' => 'Crear curso'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('CursosController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de curso</div>
              <div class="card-body">
                <br>

                  <div class="row">

                    <div class="col-lg-3 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nivel</h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="nivel" class="form-control"  placeholder="Ingrese nivel del curso" value="{{ old('nivel') }}" style="margin-top:5px;" > 
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>

                    <div class="col-lg-3 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Letra </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="letra" class="form-control"  placeholder="Ingrese letra del curso" value="{{ old('letra') }}" style="margin-top:5px;" > 
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>

                    {{-- <div class="col-lg-3 col-xs-12">
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
                                  <select class="select2 " name="asignatura_id" id="asignatura_id" style=" width:100%; ">
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

                    <div class="col-lg-3 col-xs-12">
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
                                  <select class="select2 " name="docente_id" id="docente_id" style=" width:100%; ">
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
                    </div> --}}

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
      $('#asignatura_id').select2();
      $('#docente_id').select2();
    });
</script>
@endsection


