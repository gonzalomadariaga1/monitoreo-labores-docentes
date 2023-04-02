@extends('layouts.admin')

@section('contenido')
    <main id="main" class="main">
        @include('admin.anotaciones.headersection', ['title' => 'Lista de anotaciones'])

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-7 col-xs-12">
                                <h4>Lista de anotaciones registradas en el sistema.</h4>
                            </div>

                            {{-- <div class="col-lg-2 col-xs-12">
                    <a href="{{route('admin.anotaciones.create')}}" class="btn btn-primary-violet btn-sm float-md-end" 
                    role="button" aria-pressed="true"  style="margin-bottom: 5px;">Crear anotación por docente</a>
                </div> --}}

                            <div class="col-lg-3 col-xs-12">
                                <a href="{{ route('admin.anotaciones.eliminadas') }}"
                                    class="btn btn-secondary btn-sm float-md-end" role="button" aria-pressed="true"
                                    style="margin-bottom: 5px;">Anotaciones eliminadas</a>
                            </div>

                            <div class="col-lg-2 col-xs-12">
                                <a href="{{ route('admin.anotaciones.create2') }}"
                                    class="btn btn-primary-violet btn-sm float-md-end" role="button" aria-pressed="true"
                                    style="margin-bottom: 5px;">Crear anotación</a>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
                                <br>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-amonestaciones-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-amonestaciones" type="button" role="tab"
                                            aria-controls="nav-amonestaciones" aria-selected="true">Amonestaciones</button>
                                        <button class="nav-link" id="nav-memorandum-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-memorandum" type="button" role="tab"
                                            aria-controls="nav-memorandum" aria-selected="false">Memorandum</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">



                                    <div class="tab-pane fade show active" id="nav-amonestaciones" role="tabpanel"
                                        aria-labelledby="nav-amonestaciones-tab">


                                        <table id="tabla_amonestaciones"
                                            class="table table-striped table-bordered table-hover table-responsive"
                                            width="100%">
                                            <thead style="background-color:#A27AD6">
                                                <th>Fecha</th>
                                                <th>ID correlativo</th>
                                                <th>Nombre docente </th>
                                                <th>Tareas</th>
                                                <th>Asignaturas</th>
                                                <th>Cursos</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                            <tfoot>
                                                <th>Fecha</th>
                                                <th>ID correlativo</th>
                                                <th>Nombre docente </th>
                                                <th>Tareas</th>
                                                <th>Asignaturas</th>
                                                <th>Cursos</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tfoot>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="nav-memorandum" role="tabpanel"
                                        aria-labelledby="nav-memorandum-tab">



                                        <table id="tabla_memorandum"
                                            class="table table-striped table-bordered table-hover table-responsive">
                                            <thead style="background-color:#A27AD6">
                                                <th>Fecha</th>
                                                <th>ID correlativo</th>
                                                <th>Nombre docente </th>
                                                <th>Tareas</th>
                                                <th>Asignaturas</th>
                                                <th>Cursos</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                            <tfoot>
                                                <th>Fecha</th>
                                                <th>ID correlativo</th>
                                                <th>Nombre docente </th>
                                                <th>Tareas</th>
                                                <th>Asignaturas</th>
                                                <th>Cursos</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @include('admin.anotaciones.modal-vaciar')
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#vaciarModal">Vaciar tablas</a>

                            </div>
                        </div>
                    </div>


                    <div class="modal" id="empModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detalles de la anotación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="borrarAnotacion" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Qué desea realizar con esta anotación?
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                {{-- <div class="modal-body">
                                Seleccione: <br>
                                Eliminar: si desea borrar la anotación <br>
                                Anular: si desea anular la anota
                            </div> --}}
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div>




        </div>

        {{-- @include('includes.modal-delete')
        @include('includes.modal-showmoredata') --}}
    </main>
@endsection


@section('code_js')
    {{-- <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>


    <script>
        $(document).ready(function() {


            // $('.buttonMoreInfoModal').on('click', function(event) {
            //     console.log("entre ");
            //     var button = $(event.relatedTarget)
            //     var usu_id = button.data('usuid')

            //     console.log(usu_id);


            // });




            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                var tabID = $(e.target).attr('data-bs-target');
                console.log(tabID);

                if (tabID === '#nav-memorandum') {
                    table_memo.columns.adjust().responsive.recalc();
                }

                // $('a[class^="buttonMoreInfoModal"]').click(function() {
                //     var array = $(this).data('moredata').split(",");
                //     var docente_id = array[0];
                //     var fecha = array[1];

                //     $.ajax({
                //         type: "GET",
                //         url: '/anotaciones/' + docente_id + '/' + fecha +
                //             '/show_more_data_memo/',
                //         error: function(e) {
                //             alert("Error. Informar este error. Código: 6985")
                //             console.log(e);
                //         },
                //         success: function(response) {


                //             var i = 0
                //             $('#empModal .modal-body').html(response[0].docente);

                //             $.each(response[0].restoData, function(indexInArray,
                //                 valueOfElement) {


                //                 $('#cards').append(`<div class="col">
            //                                   <div class="card w-100">
            //                                       <div class="card-header">` + indexInArray + `</div>
            //                                         <div class="card-body">
            //                                           <div class="col">
            //                                             <span><strong>Asignatura(s): </strong></span>
            //                                             <div id="bodyasignatura` + i + `"></div>
            //                                           </div>
            //                                         </div>
            //                                     </div>
            //                                   </div>`);

                //                 $.each(valueOfElement, function(asignatura,
                //                     cursos) {
                //                     $('#bodyasignatura' + i).append(
                //                         asignatura,
                //                         ' <strong>en curso(s):</strong> <div id="bodycurso' +
                //                         i + '"></div>');

                //                     $.each(cursos, function(keyCurso,
                //                         nombre_curso) {
                //                         console.log(
                //                             nombre_curso);
                //                         $('#bodycurso' + i)
                //                             .append(nombre_curso
                //                                 .nombre_curso,
                //                                 ' ');
                //                     });

                //                 });



                //                 i++;
                //             });

                //             $('#empModal').modal('show');
                //         }
                //     });

                // });

                // $('a[class^="button2MoreInfoModal"]').click(function() {
                //     var array = $(this).data('moredata').split(",");
                //     var docente_id = array[0];
                //     var fecha = array[1];

                //     console.log("entre al boton2")

                //     $.ajax({
                //         type: "GET",
                //         url: '/anotaciones/' + docente_id + '/' + fecha +
                //             '/show_more_data_amon/',
                //         error: function(e) {
                //             alert("Error. Informar este error. Código: 6985")
                //             console.log(e);
                //         },
                //         success: function(response) {


                //             var i = 0
                //             $('#empModal .modal-body').html(response[0].docente);

                //             $.each(response[0].restoData, function(indexInArray,
                //                 valueOfElement) {


                //                 $('#cards').append(`<div class="col">
            //                                   <div class="card w-100">
            //                                       <div class="card-header">` + indexInArray + `</div>
            //                                         <div class="card-body">
            //                                           <div class="col">
            //                                             <span><strong>Asignatura(s): </strong></span>
            //                                             <div id="bodyasignatura` + i + `"></div>
            //                                           </div>
            //                                         </div>
            //                                     </div>
            //                                   </div>`);

                //                 $.each(valueOfElement, function(asignatura,
                //                     cursos) {
                //                     $('#bodyasignatura' + i).append(
                //                         asignatura,
                //                         ' <strong>en curso(s):</strong> <div id="bodycurso' +
                //                         i + '"></div>');

                //                     $.each(cursos, function(keyCurso,
                //                         nombre_curso) {
                //                         console.log(
                //                             nombre_curso);
                //                         $('#bodycurso' + i)
                //                             .append(nombre_curso
                //                                 .nombre_curso,
                //                                 ' ');
                //                     });

                //                 });



                //                 i++;
                //             });

                //             $('#empModal').modal('show');
                //         }
                //     });

                // });

            });

            var table_amon = $('#tabla_amonestaciones').DataTable({

                initComplete: function() {
                    this.api().columns([0]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value="">Todas</option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                },

                // responsive: true,
                scrollY: false,
                scrollX: false,
                dom: 'lBfrtip',

                ajax: {
                    url: '/anotaciones/get_anotaciones_tipo_amonestacion_groupby_docente',
                    type: "get",
                    dataType: "json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                },



                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },


            });

            // Apply a search to the second table for the demo
            var table_memo = $('#tabla_memorandum').DataTable({
                initComplete: function() {
                    this.api().columns([0]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value="">Todas</option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                },
                // responsive: true,
                scrollY: false,
                scrollX: false,
                dom: 'lBfrtip',

                ajax: {
                    url: '/anotaciones/get_anotaciones_tipo_memo_groupby_docente',
                    type: "get",
                    dataType: "json",
                    async: false,
                    error: function(e) {
                        console.log(e.responseText);
                    }
                },



                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },


            });






        });
    </script>

    <script>
        function mostrarModalAmonestacion(id_docente, fecha) {

            console.log("id docente", id_docente);
            console.log("fecha", fecha);

            $.ajax({
                type: "GET",
                url: '/anotaciones/' + id_docente + '/' + fecha + '/show_more_data_amon/',
                error: function(e) {
                    alert("Error. Informar este error. Código: 6985")
                    console.log(e);
                },
                success: function(response) {


                    var i = 0;
                    var j = 0;
                    $('#empModal .modal-body').html(response[0].docente);

                    $.each(response[0].restoData, function(indexInArray, valueOfElement) {


                        $('#cards').append(`<div class="col">
                                                  <div class="card w-100">
                                                      <div class="card-header">` + indexInArray + `</div>
                                                        <div class="card-body">
                                                          <div class="col">
                                                            <span><strong>Asignatura(s): </strong></span>
                                                            <ol>
                                                            <div id="bodyasignatura` + i + `"></div>
                                                            </ol>
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </div>`);

                        $.each(valueOfElement, function(asignatura, cursos) {

                            $('#bodyasignatura' + i).append(`<li>` + asignatura + `,
                                <strong>en curso(s):</strong>  <span id="bodycurso` + j +
                                `"></span>`);


                            $.each(cursos, function(keyCurso, nombre_curso) {

                                $('#bodycurso' + j).append(`(` + nombre_curso
                                    .nombre_curso + `)&nbsp;</li>`);

                                // $('#bodycurso' + i).append(nombre_curso.nombre_curso,
                                //     ' ');
                            });

                            j++;

                        });



                        i++;
                    });

                    $('#empModal').modal('show');
                }
            });

        }


        function mostrarModalMemo(id_docente, fecha) {

            console.log("id docente", id_docente);
            console.log("fecha", fecha);

            $.ajax({
                type: "GET",
                url: '/anotaciones/' + id_docente + '/' + fecha + '/show_more_data_memo/',
                error: function(e) {
                    alert("Error. Informar este error. Código: 6985")
                    console.log(e);
                },
                success: function(response) {


                    var i = 0;
                    var j = 0;
                    $('#empModal .modal-body').html(response[0].docente);

                    $.each(response[0].restoData, function(indexInArray, valueOfElement) {


                        $('#cards').append(`<div class="col">
                                      <div class="card w-100">
                                          <div class="card-header">` + indexInArray + `</div>
                                            <div class="card-body">
                                              <div class="col">
                                                <span><strong>Asignatura(s): </strong></span>
                                                <div id="bodyasignatura` + i + `"></div>
                                              </div>
                                            </div>
                                        </div>
                                      </div>`);

                        $.each(valueOfElement, function(asignatura, cursos) {

                            $('#bodyasignatura' + i).append(`<li>` + asignatura + `,
                                <strong>en curso(s):</strong>  <span id="bodycurso` + j +
                                `"></span>`);

                            $.each(cursos, function(keyCurso, nombre_curso) {

                                $('#bodycurso' + j).append(`(` + nombre_curso
                                    .nombre_curso + `)&nbsp;</li>`);

                                // $('#bodycurso' + i).append(nombre_curso.nombre_curso,
                                //     ' ');
                            });

                            j++;
                        });



                        i++;
                    });

                    $('#empModal').modal('show');
                }
            });

        }

        function mostrarModalBorrarMemo(id_docente, fecha, estado) {

            console.log("id docente", id_docente);
            console.log("fecha", fecha);
            console.log("estado ", estado);
            $('#borrarAnotacion .modal-footer').empty();
            if (estado == 1) {

                $('#borrarAnotacion .modal-footer').append(`
                                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                                <a href="/anotaciones/` + id_docente + `/` + fecha + `/anular_anotacion_memo/" class="btn btn-warning" role="button" aria-pressed="true">Anular</a>
                                                                <a href="/anotaciones/` + id_docente + `/` + fecha + `/borrar_anotacion/" class="btn btn-danger" role="button" aria-pressed="true">Eliminar</a>
                        `);

                $('#borrarAnotacion').modal('show');

            } else {
                $('#borrarAnotacion .modal-footer').append(`
                                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                                <a href="/anotaciones/` + id_docente + `/` + fecha + `/activar_anotacion_memo/" class="btn btn-success" role="button" aria-pressed="true">Activar</a>
                                                                <a href="/anotaciones/` + id_docente + `/` + fecha + `/borrar_anotacion/" class="btn btn-danger" role="button" aria-pressed="true">Eliminar</a>
                        `);

                $('#borrarAnotacion').modal('show');
            }



        }

        function mostrarModalBorrarAmon(id_docente, fecha, estado) {

            console.log("id docente", id_docente);
            console.log("fecha", fecha);
            console.log("estado ", estado);
            $('#borrarAnotacion .modal-footer').empty();
            if (estado == 1) {

                $('#borrarAnotacion .modal-footer').append(`
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/anotaciones/` + id_docente + `/` + fecha + `/anular_anotacion_amon/" class="btn btn-warning" role="button" aria-pressed="true">Anular</a>
                                                    <a href="/anotaciones/` + id_docente + `/` + fecha + `/borrar_anotacion/" class="btn btn-danger" role="button" aria-pressed="true">Eliminar</a>
            `);

                $('#borrarAnotacion').modal('show');

            } else {
                $('#borrarAnotacion .modal-footer').append(`
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/anotaciones/` + id_docente + `/` + fecha + `/activar_anotacion_amon/" class="btn btn-success" role="button" aria-pressed="true">Activar</a>
                                                    <a href="/anotaciones/` + id_docente + `/` + fecha + `/borrar_anotacion/" class="btn btn-danger" role="button" aria-pressed="true">Eliminar</a>
            `);

                $('#borrarAnotacion').modal('show');
            }



        }
    </script>
@endsection
