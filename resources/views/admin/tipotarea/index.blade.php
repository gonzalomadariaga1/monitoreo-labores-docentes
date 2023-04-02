@extends('layouts.admin')

@section('contenido')
<main id="main" class="main">
  @include('admin.tipotarea.headersection',['title' => 'Lista de tipos de tareas'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-10">
                    <h4>Lista de tipos de tareas registradas en el sistema.</h4>
                </div>

                <div class="col-md-2">
                    <a href="{{route('admin.tipotarea.create')}}" class="btn btn-primary-violet btn-sm float-md-end" 
                    role="button" aria-pressed="true"  style="margin-bottom: 5px;">Crear tipo de tarea</a>
                </div>
              </div>
            </div>
    
            <div class="card-body">
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                <table id="tabla_tipotareas" class="table table-striped table-bordered  table-hover" >
                    <thead style="background-color:#A27AD6">
                      <th>Id</th>
                      <th>Nombre </th>
                      <th>Nombre acortado</th>
                      <th>Acciones</th>                     
                    </thead>
                    <tbody>
                        
                    
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
        
        var url = '{{ route("admin.tipotarea.destroy", ":id") }}';
        url = url.replace(':id', usu_id);

        
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action',url);
    })
  </script>

  <script>
    var table = $('#tabla_tipotareas').DataTable( {
        
      scrollY:        false,
      scrollX:        false,
      dom: 'lBfrtip',
        
      ajax:{
            url: '/tipotarea/get_tipotarea',
            type : "get",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },

        

      language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },

        
  });
  </script>
    
@endsection