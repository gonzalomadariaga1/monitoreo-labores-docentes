@extends('layouts.admin')



@section('contenido')
<main id="main" class="main">
  @include('admin.anotaciones.headersection',['title' => 'Crear anotación por curso'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          {{-- <form method="POST" action="" enctype="multipart/form-data" class="submit-prevent-form"> --}}
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de anotación por curso</div>
              <div class="card-body">
                <br>

                {{-- <h3>Proceso de cambio de productos</h3> --}}
                <form id="form" method="POST" action="{{ action('AnotacionesController@store') }}" onsubmit="return check_ultimopaso(this);" enctype="multipart/form-data" class="submit-prevent-form">
                  {{ csrf_field() }}
                  <div id="stepper4" class="bs-stepper  linear">
                    <div class="bs-stepper-header" role="tablist">
                      <div class="step" data-target="#test-l-1">
                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger1" aria-controls="test-l-1" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Curso</span>
                        </button>
                      </div>

                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-2">
                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger3" aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Asignaturas</span>
                        </button>
                      </div>
                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-3">
                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger4" aria-controls="test-l-3" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Completar</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade dstepper-block dstepper-none" aria-labelledby="stepper4trigger1">

                              <div class="container">
                                  <div class="row">
                                        <div class="col-lg-4 col-xs-12"></div>
                                        <div class="col-lg-4 col-xs-12">
                                          <div class="d-flex justify-content-center">
                                            <select class="selectpicker select_curso"  title="Seleccione curso..." data-live-search="true"  data-width="auto" name="curso_id" id="select_curso" >
                                              
                                              @foreach ($cursos as $curso)
                                                  
                                                  <option value="{{$curso->id}}">{{$curso->nivel}} {{$curso->letra}}</option>
                                              @endforeach
                                            </select> 
                                          </div>
                                          
                                          
                                        </div>
                                        <div class="col-lg-4 col-xs-12"></div>

                                        {{-- <div class="col-lg-6 col-xs-6">
                                          <div class="d-flex justify-content-center">
                                            <select class="selectpicker select_paralelo"  title="Seleccione paralelo..." data-live-search="true"  data-width="35%" name="paralelo_id" id="select_paralelo" >
                                            </select>
                                          </div>
                                           
                                        </div> --}}

                                      
                                  </div>

                                  
                              </div>
                              
                          
                            



                          <br>

                          

                          <br/>
                            

                          

                          
                          <button type="button" class="btn btn-primary" id="curso-to-asignatura">Siguiente</button>
                        </div>



                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger2">

                          <div class="row">
                            <div class="d-flex justify-content-center">
                              <div class="col-lg-2">
                                <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon3">Curso:</span>
                                  <input type="text" class="form-control" id="curso_seleccionado" aria-describedby="basic-addon3" disabled>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">

                            
                            
                            
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 Para añadir una asignatura, presione el botón <strong>Añadir asignatura.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              <table id="horario" class="table table-striped" style="border-radius: 4px;">
                                  <thead style="background-color:#7fbdff; " >
                                      <th>#</th>
                                      <th>Asignatura</th>
                                      <th>Docente</th>
                                      
                                      <th>Tarea(s)</th>
                                      <th>Acción</th>
                                      {{-- <th><button type="button" class="btn btn-sm btn-success-violet" id="addrow"> <i class="bi bi-plus-lg"></i> Añadir tarea </button></th> --}}
                                      
                                  </thead>
        
                                  <tbody>
        
        
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="5" style="text-align: left;">
                                        {{-- <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" /> --}}
                                        <div class="d-grid gap-2">
                                          <button class="btn btn-outline-secondary" type="button" id="addrow">Añadir asignatura</button>
                                        </div>
                                      </td>
                                    </tr>
                                    
                                  </tfoot>
                              </table>
                            </div>
                            
                          </div>

                          <br>
                          <br>
                          <br>

                          


                          <button type="button"class="btn btn-primary " id="paso2_to_paso1">Atrás</button>
                          <button type="button" class="btn btn-primary" id="resumen" >Siguiente</button>
                        </div>

                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger3">

                          <br>
                          <br>
                          <div class="card">
                            <div class="card-header">
                              <div class="d-flex justify-content-center">
                                <h4 class="">Resumen de la anotación</h4>
                            </div>
                            </div>
                            <div class="card-body">
                              <br>
                              <div class="row">
                                <div class="d-flex justify-content-center">
                                  <div class="col-lg-2">
                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="basic-addon3">Curso seleccionado</span>
                                      <input type="text" class="form-control" id="curso_seleccionado_resumen" aria-describedby="basic-addon3" disabled>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <br>
                              <label for="cards" class="form-label">Asignaturas añadidas:</label>
                              <div class="row" id="cards">
                                
                              </div>

                              <div class="row">
                                <div class="col-lg-3  col-xs-12">
                                  <div class="form-group">
                                      <label>Fecha:</label>
                                      <input type="date" name="fecha" id="fecha"  class="form-control" required>
                                  </div>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-lg-4  col-xs-12">
                                  <div class="form-group">
                                      <label class="mb-2">Referencia:</label>
                                      <select class="selectpicker select_referencia" required title="Seleccione referencia..." data-live-search="true"  data-width="100%" name="referencia_id" id="select_referencia" required>
                                        <option value="0" disabled selected>Seleccione referencia...</option>      
                                        @foreach ($referencias as $referencia)
                                            
                                            <option value="{{$referencia->id}}">{{$referencia->nombre}}</option>
                                        @endforeach
                                      </select> 
                                  </div>
                                </div>
                              </div>
                              <br/>
                              <div class="row">
                                <div class="col-lg-4  col-xs-12">
                                  <div class="form-group">
                                      <label class="mb-2">Estado:</label>
                                      <select class="selectpicker select_estado" required title="Seleccione estado..."  data-width="100%" name="estado" id="select_estado" >
                                              
                                        
                                            <option value="1" selected>Activa</option>
                                            <option value="0">Anulada</option>
                                        
                                      </select> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          

                         
                            {{--                           
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Tarea seleccionada</label>
                                    <input type="text" id="input-tarea" class="form-control" id="inputName5" disabled>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Docente seleccionado</label>
                                    <input type="text" id="input-docente" class="form-control" id="inputName5" disabled>
                                </div>

                                <div class="col-md-12">
                                  <label for="inputName5" class="form-label">Asignatura seleccionada</label>
                                  <input type="text" id="input-asignaturas" class="form-control" id="inputName5" disabled>
                                </div> --}}

                                {{-- <div class="row">
                                    

                                    <div class="col-md-6 col-xs-12">
                                        <label for="inputName5" class="form-label">Cursos seleccionados</label>
                                        <select class="form-select" multiple="" id="resumen-cursos" aria-label="multiple select example"></select>
                                    </div>

                                </div> 
                              --}}
                          
                          <br>
                          <br>

                          <button type="button" class="btn btn-primary " onclick="stepper4.previous()">Atrás</button>
                          <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                      
                    </div>
                  </div>
                </form>

              </div>
                  
              {{-- <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear">
                </div>
              </div> --}}
            </div>
            

            
          {{-- </form>  --}}
        </div>
        
      
        
        
    </div>

    <div class="modal fade" tabindex="-1" id="modalDuplicados">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title w-100"> <i class="bi bi-exclamation-circle-fill" style="color:red" ></i> <br> Atención: anotación duplicada </h5>

          </div>
          <div class="modal-body">
            En la base de datos ya se encuentran registradas las siguientes anotaciones:
            <table id="tabla_duplicados" class="table table-striped table-bordered table-condensed table-hover mt-2">
              <thead style="background-color:#A9D0F5">
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Asignatura</th>
                    <th>Docente</th>
                    <th>Tarea</th>


                    
                </thead>
                <tbody>

                </tbody>

            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('code_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(document).ready(function() {
      $('#asignatura_id').select2();
      
    });
</script>
<script>
    stepper4 = new Stepper(document.querySelector('#stepper4'))
    
    $('.my-select').selectpicker();
    $('.select_curso').selectpicker();
    $('.select_referencia').selectpicker();
    $('.select_estado').selectpicker();
    
    // $('.select_paralelo').selectpicker('hide');
    // $('.select_asignaturas').selectpicker();
    //$('.select_cursos').selectpicker();
</script>
<script>
    
    $(document).ready(function() {
      var counter = 0 ;

      var ajaxCursos = null;
      var ajaxAsignaturas = null;
      var ajaxAsignaturas_y_Docentes = null;
      var ajaxTareas = null;
      var cursoSelected = null;
      var numFilas = null;

      document.querySelector('#curso-to-asignatura').disabled = true;
      document.querySelector('#resumen').disabled = true;
      
      $(".select_curso").on("change", function() {
        document.querySelector('#curso-to-asignatura').disabled = false;
      });

      $("#curso-to-asignatura").on("click", function() {

        var curso = $("#select_curso :selected").text();
        var id_curso = $("#select_curso :selected").val()




        

        $("#curso_seleccionado").val(curso);

        stepper4.to(2);

        jQuery.ajax({
                  url: '/anotaciones/'+id_curso+'/get_asignaturas_by_curso/',
                  type: "GET",
                  dataType: "json",
                  async:false,
                  error:function(e){
                      alert("Error. Informar este error. Código: 985")
                  },
                  success:function(respuesta)
                  {
                    ajaxAsignaturas_y_Docentes = respuesta; 
                    
                  }
                  
        });
        
        jQuery.ajax({
                  url: '/anotaciones/get_tareas/',
                  type: "GET",
                  dataType: "json",
                  async:false,
                  error:function(e){
                      alert("Error. Informar este error. Código: 985")
                  },
                  success:function(respuesta)
                  {
                    ajaxTareas = respuesta; 
                    
                  }
                  
        });
        

      });

      $("#addrow").on("click", function() {
          var newRow = $("<tr>");
          var cols = "";

          
            
          cols += '<td>'+counter+'</td>';
          cols += '<td><select class="selectpicker select_asignatura" data-width="90%" title="Seleccione asignatura..." name="asignatura[]" id="select_asignatura' + counter + '"/></td>';
          cols += '<td><input type="text" class="form-control" id="docente' + counter + '" name="docente_resumen[]" disabled /></td><input type="hidden" name="docente[]" id="id_docente'+counter+'" />';
          cols += '<td><select class="selectpicker select_tareas" multiple data-selected-text-format="count > 3" data-width="auto" title="Seleccione tarea(s)..." name="tareas['+counter+'][]" id="select_tareas' + counter + '"/></td>';
          cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "   value="X"></td>';
          
          newRow.append(cols);
          $("#horario").append(newRow);

          //Select asignatura
          $("#select_asignatura"+counter).empty();
          $("#select_asignatura"+counter).prepend("<option disabled='disabled' value='9999' >Seleccione asignatura...</option>");

          for (let i = 0; i < ajaxAsignaturas_y_Docentes.length; i++) {
            
            $("#select_asignatura"+counter).append(
                $("<option></option>").attr({"value":ajaxAsignaturas_y_Docentes[i].id_asignatura , 
                                             "data-subtext": ajaxAsignaturas_y_Docentes[i].nombres+' '+ajaxAsignaturas_y_Docentes[i].apellido_paterno+ ' ' + ajaxAsignaturas_y_Docentes[i].apellido_materno ,
                                             "id_docente": ajaxAsignaturas_y_Docentes[i].id_docente
                                            }).text(ajaxAsignaturas_y_Docentes[i].nombre)
            );

            // $("#docente"+counter).val(ajaxAsignaturas_y_Docentes[i].nombres+' '+ajaxAsignaturas_y_Docentes[i].apellido_paterno+' '+ajaxAsignaturas_y_Docentes[i].apellido_materno);

          }

          //Select tareas
          $("#select_tareas"+counter).empty();
          $("#select_tareas"+counter).prepend("<option disabled='disabled' value='0' >Seleccione tarea(s)...</option>");

          for (let i = 0; i < ajaxTareas.length; i++) {
            
            $("#select_tareas"+counter).append(
                $("<option></option>").attr(
                    {"value": ajaxTareas[i].id , "data-subtext": ajaxTareas[i].slug_nombre_tipotarea }).text(ajaxTareas[i].slug_nombre)
            );

          }


          $('#select_tareas'+counter).selectpicker();
          // $('#select_cursos'+counter).selectpicker();
          $('#select_asignatura'+counter).selectpicker();

          //$('#select_cursos'+counter).selectpicker('render');


          $("#select_asignatura"+counter).on("change", function() {

            document.querySelector('#resumen').disabled = false;
            var optionSelected = $(this).find('option:selected').attr('id_docente');

            
            
            for (let i = 0; i < ajaxAsignaturas_y_Docentes.length; i++) {

              
              if ( ajaxAsignaturas_y_Docentes[i].id_asignatura == $( this ).val() && ajaxAsignaturas_y_Docentes[i].id_docente == optionSelected ){


                $("#id_docente"+(counter-1)).val(ajaxAsignaturas_y_Docentes[i].id_docente);

                $("#docente"+(counter-1) ).val(ajaxAsignaturas_y_Docentes[i].nombres+' '+ajaxAsignaturas_y_Docentes[i].apellido_paterno+' '+ajaxAsignaturas_y_Docentes[i].apellido_materno);
              }


              
            }


          });

          
          counter++;
          
      });



        
      $("#horario").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        counter -= 1
        if ( counter == 0){
          document.querySelector('#resumen').disabled = true;
        }
      });

      $("#paso2_to_paso1").on("click", function() {
          counter = 1;
          $("#horario tbody tr").empty();
          document.querySelector('#resumen').disabled = true;
          stepper4.to(1);
          // console.log("contador",counter);
          // console.log("cols",cols);
      });

      $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
      });

      $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
      });

      $("#resumen").on("click", function() {
        
        getDateTime('#fecha');
        $("#cards").empty();
        var asignatura = $("[name='asignatura[]'] :selected");
        var docente = $("[name='docente_resumen[]'] ");
        var tareas2 = $(".select_tareas");
        var valoresAsignaturasSelected = [];
        var isFail = 0 ;

        for (let z = 0; z < asignatura.length; z++) {
          const element = asignatura[z];
          valoresAsignaturasSelected.push(element.value)
        }


        const isDuplicate = valoresAsignaturasSelected.some((item, index) => index !== valoresAsignaturasSelected.indexOf(item));

        if (!isDuplicate) {
            //console.log(`Array doesn't contain duplicates.`);
        } else {
            console.log(`hay duplicados`);
            isFail = 1 ;
            Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'OK',
                        text: 'No es posible agregar asignaturas duplicadas',
                        footer: '',
                        showCloseButton: true,
                        timer: 5000
            });
        }
        
        var texto_curso_seleccionado = $("#curso_seleccionado").val();

        $("#curso_seleccionado_resumen").val(texto_curso_seleccionado);

        
        for (let i = 0; i < asignatura.length; i++) {
          
          var tareas = $("[name='tareas["+i+"][]'] option:selected");
          

          // console.log("tareas:",tareas[0].dataset.subtext)

          $('#cards').append(
              '<div class="col"><div class="card w-100" id="card_resumen'+i+'"><div class="card-header">'+asignatura[i].text+'</div><div class="card-body"><div class="col"><span><strong>Docente: </strong></span>'+docente[i].value+'<br><span><strong>Tareas: </strong></span><div id="bodycursos'+i+'"></div></div></div></div></div>'
          );


          if( tareas.length == 0 )
          {
            console.log("no hay tareas en la asignatura num:",i);
            isFail = 1;
            Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'OK',
                        text: 'No es posible agregar una asignatura sin tareas asociadas',
                        footer: '',
                        showCloseButton: true,
                        timer: 5000
            });
          }
          else
          {

            for (let j = 0; j < tareas.length; j++) {

              if( tareas[j].dataset.subtext == 'Amon' ){
                $('#bodycursos'+i).append('<span class="badge bg-warning me-1" style="color:black;">'+tareas[j].text+'</span>');

              }else{
                $('#bodycursos'+i).append('<span class="badge bg-secondary me-1">'+tareas[j].text+'</span>');
              }
            
            
            
            }
            

          }
        }


        if ( isFail == 1){
          stepper4.to(2);
        }else{
          stepper4.to(3);
        }
        

        
      });





    });

    


    
</script>
<script>
  function getDateTime(id) {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'-'+month+'-'+day+'T'+hour+':'+minute;
        $(id).val(dateTime);   
         return dateTime;
    }
</script>

<script>
  function check_ultimopaso( form ){
    var referencia = $("#select_referencia :selected").val()

    var id_curso = $("#select_curso :selected").val()
    var asignatura = $("[name='asignatura[]'] :selected");
    var fecha = $("#fecha").val()
    var data;
    var dataDuplicated = [];


    jQuery.ajax({
      url: '/anotaciones/'+id_curso+'/'+fecha+'/data_duplicated/',
      type: "GET",
      dataType: "json",
      async:false,
      error:function(e){
          alert("Error. Informar este error. Código: 985")
      },
      success:function(respuesta)
      {
        data = respuesta; 
        
      }
                  
    });


    //console.log(data);
    $.each(data, function(index, valor) {
      //console.log(index,valor);

      for (let i = 0; i < asignatura.length; i++) {
                  
        var tareas = $("[name='tareas["+i+"][]'] option:selected");

        for (let j = 0; j < tareas.length; j++) {
          if  (
                valor.asignatura_id == asignatura[i].value && 
                valor.docente_id == asignatura[i].getAttribute('id_docente') &&
                valor.tarea_id == tareas[j].value
              ) 
              {
              
              const values = {
                asignatura_id   : valor.asignatura_id,
                asignatura_text : asignatura[i].text,
                docente_id      : valor.docente_id,
                docente_text    : asignatura[i].getAttribute('data-subtext'),
                tarea_id        : valor.tarea_id,
                tarea_text      : tareas[j].text,
                fecha           : fecha
              }

              dataDuplicated.push(values)
    
              }
        
        
        
        }
            

      }
    });

    console.log("array de dataDuplicated",dataDuplicated);

    if ( dataDuplicated.length != 0 ){
      $("#tabla_duplicados tbody").empty();
      var contador = 1;
      for (let d = 0; d < dataDuplicated.length; d++) {
        
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td>'+contador+'</td>';
        cols += '<td>'+dataDuplicated[d].fecha+'</td>';
        cols += '<td>'+dataDuplicated[d].asignatura_text+'</td>';
        cols += '<td>'+dataDuplicated[d].docente_text+'</td>';
        cols += '<td>'+dataDuplicated[d].tarea_text+'</td>';

        
        newRow.append(cols);
        $("#tabla_duplicados").append(newRow);
        
        contador++;
      }
      $('#modalDuplicados').modal('show');
      return false ;      
    }else if (referencia == 0 ){
      Swal.fire({
        type: 'error',
        icon: 'error',
        title: 'Error',
        confirmButtonText: 'OK',
        text: 'Seleccione referencia',
        footer: '',
        showCloseButton: true,
        timer: 5000
      });
      return false
    }
    else{
      return true;
      //return false;
    }
    }
</script>
@endsection

