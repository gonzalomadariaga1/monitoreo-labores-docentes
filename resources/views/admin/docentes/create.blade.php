@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.docentes.headersection',['title' => 'Crear docente'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('DocentesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de docente</div>
              <div class="card-body">
                <br>
                  <div class="row">
                    

                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>RUT del docente </h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="rut" class="form-control"  placeholder="Ingrese RUT, sin puntos y sin guión." value="{{ old('rut') }}" style="margin-top:5px;" >
                                    
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>



                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombres</h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="nombres" class="form-control"  placeholder="Ingrese nombres del docente" value="{{ old('nombres') }}" style="margin-top:5px;" > 
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
                                <h4>Apellido paterno del docente </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="apellido_paterno" class="form-control"  placeholder="Ingrese apellido paterno del docente" value="{{ old('apellido_paterno') }}" style="margin-top:5px;" > 
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
                                <h4>Apellido materno del docente </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="apellido_materno" class="form-control"  placeholder="Ingrese apellido materno del docente" value="{{ old('apellido_materno') }}" style="margin-top:5px;" > 
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

