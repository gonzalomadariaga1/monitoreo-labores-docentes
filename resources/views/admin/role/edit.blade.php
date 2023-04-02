@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Roles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{route('admin.role.index')}}">Roles</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="/roles/{{ $row->id }}" enctype="multipart/form-data" class="submit-prevent-form">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Editar rol</div>
              <div class="card-body">
                  {{-- Card para el nombre y descripción del rol --}}
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-12">
                            <h4>Nombre y descripción del rol </h4>
                        </div>
      
                      </div>
                    </div>
                    
                    <div class="card-body">        
                      <div class="row">
                        <div class="col-lg-4  col-xs-12">
                            <div class="form-group">
                                <span style="color:red; padding-right:5px;">*</span><label for="name">Nombre del rol</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del rol" value="{{ $row->name }}" >
                            </div>
                        </div>
      
                        <div class="col-lg-8 col-xs-12">
                          <div class="form-group">
                              <span style="color:red; padding-right:5px;">*</span><label for="description">Descripción </label>
                              <br>
                              <input type="text" class="form-control" name="description" placeholder="Descripción del rol" id="description" value="{{ $row->description }}">
      
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
      
                  {{-- Card para asignacion de permisos --}}
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-12">
                            <h4>Asignar permisos al rol</h4>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-body">        
                      <div class="row">
                       {{-- Checkboxes  --}}
                          <div class="form-group">
                            @foreach($permissions as $permiso)
                            <div class="custom-control custom-checkbox form-control">
                                <input type="checkbox" class="custom-control-input" id="permiso_{{$permiso->id}}" value="{{$permiso->id}}" name="permiso[]"
                                
                                {{$row->hasPermissionTo($permiso->id) ? 'checked' : ''}}
                                > 
                                
                                <label class="custom-control-label" for="permiso_{{$permiso->id}}">
                                {{$permiso->id}}
                                -
                                {{$permiso->description}}
        
                                </label>
                              </div>
                            @endforeach
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