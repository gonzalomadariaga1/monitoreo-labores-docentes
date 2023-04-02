@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Usuarios</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Usuarios</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form method="POST" action="/users/{{ $usuarios->id }}" enctype="multipart/form-data" class="submit-prevent-form">
        {{csrf_field()}}
        {{ method_field('PATCH') }}

        <div class="card">
            <div class="card-header">
                <h2>Editar usuario</h2>
            </div>
            @include('includes.form-error')

            <div class="card-body">
                <br>
                {{-- Datos del usuario --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Datos del usuario</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Nombre y apellidos</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre y apellidos..." value=" {{ $usuarios->name }}" required>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value=" {{ $usuarios->email }} ">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña..." required minlength="8">
                                </div>
                            </div>
                    
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Repita contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repita contraseña..." id="password_confirmation">
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>

                {{-- Roles para el usuario --}}
                {{-- <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-12">
                            <h4>Asignar roles al usuario</h4>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-body">        
                      <div class="row">
                      
                          <div class="form-group">
                            @foreach($roles as $permiso)
                            <div class="custom-control custom-checkbox form-control">
                                <input type="checkbox" class="custom-control-input" id="permiso_{{$permiso->id}}" value="{{$permiso->id}}" name="permiso[]"
                                
                                {{$usuarios->hasRole($permiso->id) ? 'checked' : ''}}
                                > 
                                
                                <label class="custom-control-label" for="permiso_{{$permiso->id}}">
                                {{$permiso->id}}
                                -
                                {{$permiso->name}}
        
                                </label>
                              </div>
                            @endforeach
                          </div>
                      </div>
                    </div>
                </div>  --}}




                <div class="card-footer">
                    <div class="form-group pt-2">
                      <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
    
                      <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Editar">
                    </div>
                  </div>
        </div>

        
    </form>
  </main>
@endsection