@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.tarea.headersection',['title' => 'Crear tarea'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <form method="POST" action="{{ action('TareaController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de tarea</div>
              <div class="card-body">
                <br>

                  <div class="row">



                    <div class="col-lg-6 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre de tarea </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control"  placeholder="Ingrese nombre de tarea" value="{{ old('nombre') }}" style="margin-top:5px;" > 
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre acortado de tarea </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="slug_nombre" class="form-control"  placeholder="Ingrese nombre acortado de tarea" value="{{ old('slug_nombre') }}" style="margin-top:5px;" > 
                                </div>
                            </div>
                          </div> 
                        </div>
    
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      <div class="card">

                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Tipo de tarea </h4>  
                            </div>
                          </div>
                        </div>
                
                        <div class="card-body">        
                          <div class="row mt-2">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                  <select class="select2 " name="tipo_tarea_id" id="tarea_id" style=" width:100%; ">
                                    <option value="0" disabled selected>Seleccione tipo de tarea...</option>
                                    @foreach ($tipotarea as $t)
                                        
                                        <option value="{{ $t->id }}" > 
                                          {{$t->nombre}} </option>
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
      $('#tarea_id').select2();
    });
</script>
@endsection


