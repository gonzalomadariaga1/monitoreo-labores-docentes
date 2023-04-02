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
                <div class="col-md-10">
                    <h4>Lista de los usuarios registrados en el sistema.</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin.users.create')}}" class="btn btn-primary-violet btn-sm float-md-end" role="button" aria-pressed="true" style="margin-bottom: 5px;">Crear usuario</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Rol</th>
                      
                      <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                              @if ( $user->getRoleNames()->isEmpty()  )
                              <span class="badge bg-danger"> Sin rol</span> 

                              @else
                                @foreach ($user->getRoleNames() as $rol )
                                  <span class="badge bg-info text-dark"> {{ $rol}} </span> 
                                @endforeach
                              @endif
                            </td>
                            
                            <td>
                                <a href="{{URL::action('UsersController@show',$user['id'])}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{URL::action('UsersController@edit',$user['id'])}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{URL::action('UsersController@edit_permission',$user['id'])}}" class="btn btn-primary-violet btn-sm mb-1" style="margin-right:3px;"><i class="bi bi-unlock"></i></a>
                                
                                <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid="{{$user['id']}}"><i class="bi bi-x-lg"></i></a>
                            </td>
                        </tr>
                            
                        @endforeach
                    
                    </tbody>
                </table>
              </div>
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
    
    var url = '{{ route("admin.users.destroy", ":id") }}';
    url = url.replace(':id', usu_id);

    
    
    var modal = $(this)
    // modal.find('.modal-footer #role_id').val(role_id)
    modal.find('form').attr('action',url);
})
</script>
    
@endsection