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

    <div class="card">
      <div class="card-header">
        <h4>Datos del usuario</h4>
      </div>

      <div class="card-body">
        <br>
        {{-- Nombres y Email --}}
        <div class="card">
          <div class="card-header">
              <h4>Nombres e Email </h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                      <div class="form-group">
                          <label for="Rut"><strong>Nombre del usuario:</strong> </label>
                          <p>{{$user->name}} </p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                      <div class="form-group">
                          <label for="Rut"><strong>Email del usuario:</strong> </label>
                          <p>{{$user->email}}</p>
                      </div>
                  </div>
              </div>
          </div>    
        </div>

        {{-- Rol asignado --}}
        <div class="card">
          <div class="card-header">
            <h4>Rol(es) asignado(s) al usuario</h4>
          </div>

          <div class="card-body">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
              <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                  <thead style="background-color:#A27AD6">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Permisos</th>                    
                  </thead>
                  <tbody>
                      @foreach ($user->roles as $row)
                      <tr>
                          <td>{{ $row->name }}</a></td>
                          <td>{{ $row->description }}</td>
                          <td> 
                            @foreach ($row->permissions as $permiso)  
                              <span class="badge bg-success"> {{ $permiso->description}} </span>
                              
                            @endforeach 
                          </td>
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