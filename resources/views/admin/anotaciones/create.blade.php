@extends('layouts.admin')



@section('contenido')
<main id="main" class="main">
  @include('admin.anotaciones.headersection',['title' => 'Crear anotación'])

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          {{-- <form method="POST" action="" enctype="multipart/form-data" class="submit-prevent-form"> --}}
            {{ csrf_field() }}
            <div class="card">
              @include('includes.form-error')
              <div class="card-header">Creación de anotación</div>
              <div class="card-body">
                <br>

                {{-- <h3>Proceso de cambio de productos</h3> --}}
                <form id="form" method="POST" action="{{ action('AnotacionesController@store') }}" enctype="multipart/form-data" class="submit-prevent-form">
                  {{ csrf_field() }}
                  <div id="stepper4" class="bs-stepper  linear">
                    <div class="bs-stepper-header" role="tablist">
                      <div class="step" data-target="#test-l-1">
                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger1" aria-controls="test-l-1" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Docente</span>
                        </button>
                      </div>

                      <div class="bs-stepper-line"></div>
                      <div class="step" data-target="#test-l-2">
                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger3" aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Tareas</span>
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

                                  {{-- <div class="row">
                                      <div class="d-flex justify-content-center">
                                          <span>Seleccione tarea</span>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="d-flex justify-content-center">
                                          <div class="form-group">
                                              <select class="selectpicker my-select"  data-width="auto" data-live-search="true"  name="" id="select_tarea">
                                              <option data-subtext="Amonestación">Sin calif. en Miaula</option>
                                              <option data-subtext="Memo">No cumple mín. de calif. en Miaula</option>
                                              <option data-subtext="Memo">Sin Califiacaciones en Libro de Clases</option>
                                              <option data-subtext="Memo">No cumple mín. de calif. en Libro de Clases</option>
                                              <option data-subtext="Memo">Calif. exceden 20% Reprobados</option>
                                              <option data-subtext="Amonestación">Sin Leccionario	</option>
                                              <option data-subtext="Memo">Leccionario Atrasado</option>
                                              <option data-subtext="Memo">Leccionario Incompleto</option>
                                              <option data-subtext="Memo">Sin registro de clase de la Reforzamiento</option>
                                              <option data-subtext="Memo">Sin registro de clase de la Retroalimentación</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <br>
                                  <br> --}}
                                  <div class="row">
                                      <div class="d-flex justify-content-center">
                                          <span>Seleccione docente</span>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="d-flex justify-content-center">
                                          <div class="form-group">
                                              <select class="selectpicker select_docentes" data-live-search="true"  data-width="auto" name="docente_id" id="select_docentes" >
                                                <option value="0" disabled selected>Seleccione docente...</option>
                                                @foreach ($docentes as $docente)
                                                    
                                                    <option value="{{ $docente->id }}" > 
                                                      {{$docente->nombres}} {{$docente->apellido_paterno}}  {{$docente->apellido_materno}}</option>
                                                @endforeach
                                              </select>  
                                          </div>
                                      </div>
                                  </div>  
                                  
                              </div>
                              
                          
                            



                          <br>

                          

                          <br/>
                            

                          

                          
                          <button type="button" class="btn btn-primary" id="docenteSelected">Next</button>
                        </div>



                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger2">

                          {{-- <div class="row">
                              <div class="col-lg-6 col-xs-12">
                                  <div class="form-group">
                                      <label for="">Seleccione asignaturas</label>
                                      <br>
                                      <select class="selectpicker select_asignaturas"   name="" id="select_asignaturas"></select>
                                  </div>
                                  
                                      
                                      
                                  
                              </div>
                              <div class="col-lg-6 col-xs-12">
                                  <div class="form-group">
                                      <label for="">Seleccione cursos</label>
                                      <br>
                                      <select class="selectpicker form-control select_cursos " multiple data-actions-box="true" name="" id="select_cursos"></select>
                                  </div>
                                  
                              </div>
                          </div> --}}

                          <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 col-sm-12 col-md-12 col-xs-12 table-responsive">
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 Para añadir una tarea, presione el botón <strong>Añadir tarea.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              <table id="horario" class="table table-striped" style="border-radius: 4px;">
                                  <thead style="background-color:#7fbdff; " >
                                      <th>#</th>
                                      <th>Tarea</th>
                                      <th>Asignatura</th>
                                      <th>Curso(s)</th>
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
                                          <button class="btn btn-outline-secondary" type="button" id="addrow">Añadir tarea</button>
                                        </div>
                                      </td>
                                    </tr>
                                    
                                  </tfoot>
                              </table>
                            </div>
                            <div class="col-lg-1"></div>
                          </div>

                          <br>
                          <br>
                          <br>

                          


                          <button type="button"class="btn btn-primary " id="paso2_to_paso1">Previous</button>
                          <button type="button" class="btn btn-primary" id="resumen" >Next</button>
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
                              <div class="col-md-12">
                                <label for="inputName5" class="form-label">Docente seleccionado</label>
                                <input type="text" id="input-docente" class="form-control" id="inputName5" disabled>
                              </div>

                              <br>
                              <label for="cards" class="form-label">Tareas añadidas:</label>
                              <div class="row" id="cards">
                                
                              </div>

                              <div class="row">
                                <div class="col-lg-3  col-xs-12">
                                  <div class="form-group">
                                      <label>Fecha:</label>
                                      <input type="datetime-local" name="fecha" id="fecha"  class="form-control" required>
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

                          </div> --}}
                          
                          <br>
                          <br>

                          <button type="button" class="btn btn-primary " onclick="stepper4.previous()">Previous</button>
                          <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                      
                    </div>
                  </div>
                </form>

              </div>
                  
              <div class="card-footer">
                <div class="form-group pt-2">
                  <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>   Volver</a>

                  {{-- <input class="btn btn-success-violet submit-prevent-button" type="submit" value="Crear"> --}}
                </div>
              </div>
            </div>
            

            
          {{-- </form>  --}}
        </div>
        
      
        
        
    </div>
  </main>
@endsection

@section('code_js')
<script>
  $(document).ready(function() {
      $('#asignatura_id').select2();
      
    });
</script>
<script>
    stepper4 = new Stepper(document.querySelector('#stepper4'))
    
    $('.my-select').selectpicker();
    $('.select_docentes').selectpicker();
    // $('.select_asignaturas').selectpicker();
    //$('.select_cursos').selectpicker();
</script>
<script>
    
    $(document).ready(function() {
      var counter = 0 ;

      var ajaxCursos = null;
      var ajaxAsignaturas = null;
      var ajaxTareas = null;
      

      $("#docenteSelected").on("click", function() {
        var id_docente = $("#select_docentes :selected").val();

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
        
        jQuery.ajax({
                  url: '/anotaciones/'+id_docente+'/get_cursos/',
                  type: "GET",
                  dataType: "json",
                  async:false,
                  error:function(e){
                      alert("Error. Informar este error. Código: 985")
                  },
                  success:function(respuesta)
                  {
                    ajaxCursos = respuesta; 
                    

                    // $("#select_cursos").empty();
                    // $("#select_cursos").prepend("<option disabled='disabled' value='0' >Seleccione cursos...</option>");
                    
                    // for (let i = 0; i < respuesta.length; i++) {

                    //     $("#select_cursos").append(
                    //         $("<option></option>").attr(
                    //             "value", respuesta[i].id).text(respuesta[i].nivel+" "+respuesta[i].letra )
                    //     );
                        
                    // }
                    // $('#select_cursos').selectpicker('refresh');
                    
                  }
                  
        });

        jQuery.ajax({
                  url: '/anotaciones/'+id_docente+'/get_asignaturas/',
                  type: "GET",
                  dataType: "json",
                  async:false,
                  error:function(e){
                      alert("Error. Informar este error. Código: 985")
                  },
                  success:function(respuesta)
                  {
                    ajaxAsignaturas = respuesta
                    // console.log(respuesta.length)

                    // $("#select_asignaturas").empty();
                    // $("#select_asignaturas").prepend("<option disabled='disabled' value='0' selected>Seleccione asignatura...</option>");

                    // for (let i = 0; i < respuesta.length; i++) {
                    //     console.log(respuesta[i].id)
                    //     console.log(respuesta[i].nombre)
                    //     $("#select_asignaturas").append(
                    //         $("<option></option>").attr(
                    //             "value", respuesta[i].id).text(respuesta[i].nombre)
                    //     );
                        
                    // }
                    // $("#select_asignaturas").selectpicker("render");
                    // $('#select_asignaturas').selectpicker('refresh');
                    
                  }
                  
        });

        stepper4.to(2);

      });

      $("#addrow").on("click", function() {
          var newRow = $("<tr>");
          var cols = "";

          
            
          cols += '<td>'+counter+'</td>';
          cols += '<td><select class="selectpicker select_tareas" title="Seleccione tarea..." name="tarea[]" id="select_tareas' + counter + '"/></td>';
          cols += '<td><select class="selectpicker select_asignaturas" title="Seleccione asignatura..." name="asignatura[]" id="select_asignaturas' + counter + '"/></td>';
          cols += '<td><select class="selectpicker select_cursos" multiple title="Seleccione curso(s)..." name="cursos['+counter+'][]" id="select_cursos' + counter + '"/></td>';
          cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "   value="X"></td>';
          
          newRow.append(cols);
          $("#horario").append(newRow);

          //Select tareas
          $("#select_tareas"+counter).empty();
          $("#select_tareas"+counter).prepend("<option disabled='disabled' value='0' >Seleccione tarea...</option>");

          for (let i = 0; i < ajaxTareas.length; i++) {
            
            $("#select_tareas"+counter).append(
                $("<option></option>").attr(
                    {"value": ajaxTareas[i].id , "data-subtext": ajaxTareas[i].slug_nombre_tipotarea }).text(ajaxTareas[i].slug_nombre)
            );

          }
          
          //Select asignaturas
          $("#select_asignaturas"+counter).empty();
          $("#select_asignaturas"+counter).prepend("<option disabled='disabled' value='0' >Seleccione asignaturas...</option>");

          for (let i = 0; i < ajaxAsignaturas.length; i++) {
            
            $("#select_asignaturas"+counter).append(
                $("<option></option>").attr(
                    "value", ajaxAsignaturas[i].id).text(ajaxAsignaturas[i].nombre)
            );

          }

          // Select cursos
          $("#select_cursos"+counter).empty();
          $("#select_cursos"+counter).prepend("<option disabled='disabled' value='0' >Seleccione cursos...</option>");

          for (let i = 0; i < ajaxCursos.length; i++) {

            $("#select_cursos"+counter).append(
                $("<option></option>").attr(
                    "value", ajaxCursos[i].id).text(ajaxCursos[i].nivel+" "+ajaxCursos[i].letra )
            );

          }

          $('#select_tareas'+counter).selectpicker();
          $('#select_cursos'+counter).selectpicker();
          $('#select_asignaturas'+counter).selectpicker();

          //$('#select_cursos'+counter).selectpicker('render');
          counter++;
          
      });



        
      $("#horario").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        counter -= 1
      });

      $("#paso2_to_paso1").on("click", function() {
          counter = 1;
          $("#horario tbody tr").empty();
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
        var tareas = $("[name='tarea[]'] :selected");
        var asignatura = $("[name='asignatura[]'] :selected");
        
        var texto_docente = $("#select_docentes :selected").text();

        $("#input-docente").val(texto_docente.trim());

       
        for (let i = 0; i < tareas.length; i++) {
          
          var cursos = $("[name='cursos["+i+"][]'] option:selected");
          console.log("cursos:",cursos)

          $('#cards').append(
              '<div class="col"><div class="card w-100" id="card_resumen'+i+'"><div class="card-header">'+tareas[i].text+'</div><div class="card-body"><div class="col"><span><strong>Asignatura: </strong></span>'+asignatura[i].text+'<br><span><strong>Cursos: </strong></span><div id="bodycursos'+i+'"></div></div></div></div></div>');
          
          for (let j = 0; j < cursos.length; j++) {
            
            $('#bodycursos'+i).append('<span class="badge bg-secondary me-1">'+cursos[j].text+'</span>');
            
          }
          
        }

        stepper4.to(3);
      });

    });

    

    // function resumen(){

    //     var selectedCursos = [];


    //     var selectedValues = [];
    //     var texto_tarea = $("#select_tarea :selected").text();
    //     var texto_docente = $("#select_docentes :selected").text();
    //     var texto_asignaturas = $("#select_asignaturas :selected").text();

    //     $('#select_cursos :selected').each(function(i, value){ 
             
    //         selectedCursos[i] = $(value).text(); 

    //     });

       
        
        
    //     $("#input-tarea").val(texto_tarea);
    //     $("#input-docente").val(texto_docente.trim());
    //     $("#input-asignaturas").val(texto_asignaturas);

    //     $("#resumen-cursos").empty();
    //     for (let i = 0; i < selectedCursos.length; i++) {

    //         $("#resumen-cursos").append(
    //             $("<option></option>").attr(
    //                 "value", selectedCursos[i][0]).text(selectedCursos[i])
    //         );
            
    //     }

       

    //     //stepper4.to(3);

    // }

    // var cont=1;
    // var detalles=0;

    // function agregarNew(){
      
    //     var fila = '<tr class="filas" id="fila'+cont+'">'+
    //             '<td><span>'+cont+'</span></td>'+
    //             '<td><div class="form-group"><select class="selectpicker form-control select_cursos_'+cont+' " multiple data-actions-box="true" name="" id="select_cursos_'+cont+'"></select></div></td>'+
    //             '<td><input type="time" id="inputMDEx1" name="hora_fin[]" class="form-control"></td>'+
    //             '<td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    //             '</tr>';
    //         cont++;
    //         detalles=detalles+1;
    //         $(".select_cursos_"+cont).selectpicker();
    //         $('#horario').append(fila);
            
    // }

    // function eliminarDetalle(indice){
    //   $("#fila" + indice).remove();
      
    //   detalles=detalles-1;
    // }

    
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

@endsection

