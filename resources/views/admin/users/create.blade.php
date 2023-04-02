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

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                    <h4>Crear usuario</h4>
                </div>
                <div class="col-md-2">
                  {{-- <a href="{{route('ventas.cambios')}}" class="btn btn-primary-violet btn-lg float-md-right" role="button" aria-pressed="true" style="margin-bottom: 5px;">Cambios</a> --}}
              </div>
                <div class="col-md-2">
                    {{-- <a href="{{route('ventas.create')}}" class="btn btn-primary-violet btn-lg float-md-right" role="button" aria-pressed="true" style="margin-bottom: 5px;">Ingresar venta</a> --}}
                </div>
              </div>
            </div>
            @include('includes.form-error')
            <div class="card-body">
                <form method="POST" action="/users" enctype="multipart/form-data" class="submit-prevent-form">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <span style="color:red; padding-right:5px;">*</span><label for="name">Nombre y Apellidos</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre y apellidos..." value="{{ old('name') }}" >
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <span style="color:red; padding-right:5px;">*</span><label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <span style="color:red; padding-right:5px;">*</span><label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese su contraseña con 8 caractéres como mínimo." required minlength="8">
                            </div>
                        </div>
                
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <span style="color:red; padding-right:5px;">*</span><label for="password_confirmation">Repita contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repita la contraseña" id="password_confirmation">
                            </div>
                        </div>
                    </div>
        
        
                    
                   
                    <div class="form-group pt-2">
                      <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                        <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
                    </div>
                </form> 
            </div>
    
        
        
            
          </div>
        </div>
        
      
        
        
    </div>

    @include('includes.modal-delete')
  </main>
@endsection

@section('code_js')
  <script>
      $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var usu_id = button.data('usuid') 
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action','/users/' + usu_id);
    })
  </script>
    
@endsection