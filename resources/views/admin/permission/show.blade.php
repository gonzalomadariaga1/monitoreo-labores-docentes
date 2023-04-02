@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Permisos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Permisos</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">

      <div class="card-header">
        <h4>Datos del permiso</h4>
      </div>
      
      <div class="card-body">
        <br>
        {{-- nombre y descr del permiso --}}

        <div class="card">
          <div class="card-header">
              <h4>Nombre y descripción del permiso </h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-4 col-xs-12">
                      <div class="form-group">
                          <label for="Rut"><strong>Nombre del permiso:</strong> </label>
                          <p>{{$row->name}} </p>
                      </div>
                  </div>
  
                  <div class="col-lg-8 col-xs-12">
                    <div class="form-group">
                        <label for="Rut"><strong>Descripción del permiso:</strong> </label>
                        <p>{{$row->description}} </p>
                    </div>
                  </div>
              </div>  
          </div>
        </div>

        {{-- Roles asignados del permiso --}}
        @php
            $can_view_permissions = auth()->user()->can('admin-role-show');
        @endphp

        @if($can_view_permissions)
          <div class="card">
            <div class="card-header">
              <h4>Roles asignados</h4>
            </div>

            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Nombre</th>
                      <th>Descripción</th>                    
                    </thead>
                    <tbody>
                      
                        @foreach ($row->roles as $row)
                        <tr>
                            <td>{{ $row->name }}</a></td>
                            <td>{{ $row->description }}</td>
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif

        {{-- Usuarios asignados al permiso --}}
        <div class="card">
          <div class="card-header">
            <h4>Usuarios asignados</h4>
          </div>

          <div class="card-body">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
              <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                  <thead style="background-color:#A27AD6">
                    <th>Nombre</th>
                    <th>Email</th>                    
                  </thead>
                  <tbody>
                      
                      @foreach ($row->users as $user)
                      <tr>
                          <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></td>
                          
                          <td>{{ $user->email }}</td>
                      </tr>
                      @endforeach
                  
                  </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>


      <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>
      </div>
    </div>

    
  </main>
@endsection