@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
@include('admin.tipotarea.headersection',['title' => 'Editar tipo de tarea'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{ action('TipoTareaController@update', $row->id) }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Editar tipo de tarea</div>
              <div class="card-body">
                <br>
                  
                  

                  <div class="row">
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre de tipo de tarea</h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control"  placeholder="Ingrese nombre de tipo de tarea" value="{{ $row->nombre }}" style="margin-top:5px;" >
                                    
                                </div>
                            </div>
                          </div> 
                        </div>
                        
                      </div>

                    </div>
                    <div class="col-lg-6 col-xs-12">

                      {{-- Card nombre categoria italiano --}}
                      <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <h4>Nombre acortado de tipo de tarea</h4>  
                            </div>
                          </div>
                        </div>
                        
                        <div class="card-body">        
                          <div class="row">
                            <div class="col-lg-12  col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="slug_nombre" class="form-control"  placeholder="Ingrese nombre acortado de tipo de tarea" value="{{ $row->slug_nombre }}" style="margin-top:5px;" >
                                    
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
                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Editar">
                </div>
              </div>
            </div>
            

            
          </form> 
        </div>
        
      
        
        
    </div>

    
  </main>
@endsection

