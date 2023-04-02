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

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de los permisos registrados en el sistema.</h4>
                </div>
                {{-- <div class="col-md-2">
                    <a href="{{route('admin.users.create')}}" class="btn btn-primary-violet btn-sm float-md-end" role="button" aria-pressed="true" style="margin-bottom: 5px;">Crear usuario</a>
                </div> --}}
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tblarticulos" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Nombre</th>
                      <th>Descripción</th>
                    </thead>
                    <tbody>
                      @foreach ($rows as $row)
                      <tr>
                        <td><a href="{{ route('admin.permission.show' , $row->id) }}"> {{ $row->name }}</a></td>
                        <td>{{ $row->description }}</td>
                      </tr>
                          
                      @endforeach
                                            
                    </tbody>
                </table>
              </div>
            </div>
            {{ $rows->render() }}
            

            
    
        
        
            
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