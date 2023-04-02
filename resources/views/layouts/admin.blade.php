<?php 
  use App\User;
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> AdminPanel - CMadariag </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets_admin/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets_admin/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  {{-- <link href="{{asset('assets_admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

  <link href="{{asset('assets_admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">

 
  <link href="{{asset('assets_admin/vendor/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
  <link href="{{asset('assets_admin/vendor/fileinput/css/fileinput.min.css')}}" rel="stylesheet">

 

  


  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">

  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet" type="text/css" />

  {{-- DataTables --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  

  {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}

  {{-- Select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  {{-- BS Stepper --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

  

  <!-- Template Main CSS File -->
  <link href="{{asset('assets_admin/css/style.css')}}" rel="stylesheet">

  {{-- Bootstrap-select --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('home')}}" class="logo d-flex align-items-center">
        <img src="{{asset('assets_admin/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">AdminPanel</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets_admin/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                
              {{Auth::user()->name}}
              
            </h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>



            

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesión</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      {{-- MENU DE ADMINISTRACION --}}

        @if (auth()->user()->can('admin-user-show') ||
                  auth()->user()->can('admin-role-show') ||
                  auth()->user()->can('admin-permission-show')
              )
            <li class="nav-item">
              <a 
                class="nav-link @if ( (request()->segment(1) == 'users') || 
                                      (request()->segment(1) == 'permisos') || 
                                      (request()->segment(1) == 'roles') ) 
                                      ''
                                  @else
                                  collapsed
                                  @endif
                        "
                data-bs-target="#components-nav" 
                data-bs-toggle="collapse" 
                href="#">
                <span>Control de Acceso</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul 
                id="components-nav" 
                class="nav-content @if ( (request()->segment(1) == 'users') || 
                                            (request()->segment(1) == 'permisos') || 
                                            (request()->segment(1) == 'roles') ) 
                                            collapse show
                                        @else
                                          collapse
                                        @endif
                                        "
                data-bs-parent="#sidebar-nav">

                @can('admin-user-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'users') ? '' : 'collapsed' }}" href="{{route('admin.users.index')}}" >
                      <i class="bi bi-person"></i>
                      <span>Usuarios</span>
                    </a>
                  </li>
                @endcan

                @can('admin-permission-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'permisos') ? '' : 'collapsed' }}" href="{{route('admin.permission.index')}}" >
                    
                      <i class="bi bi-file-earmark-lock2-fill"></i>
                      <span>Permisos</span>
                    </a>
                  </li>
                @endcan

                @can('admin-role-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'roles') ? '' : 'collapsed' }}" href="{{route('admin.role.index')}}" >
                    
                      <i class="bi bi-person-lines-fill"></i>
                      <span>Roles</span>
                    </a>
                  </li>
                @endcan
              </ul>
            </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE ADMINISTRACION--}}

      {{-- MENU DE MANTENEDORES --}}
            @if (auth()->user()->can('admin-asignaturas-show') ||
                auth()->user()->can('admin-docentes-show') ||
                auth()->user()->can('admin-cursos-show') ||
                auth()->user()->can('admin-cursos-x-asignaturas-x-docentes-show') ||
                auth()->user()->can('admin-anotaciones-show') ||
                auth()->user()->can('admin-tarea-show') ||
                auth()->user()->can('admin-tipotarea-show') ||
                auth()->user()->can('admin-referencia-show')
            )
            <li class="nav-item">
              <a 
                class="nav-link @if ( (request()->segment(1) == 'asignaturas') || 
                                      (request()->segment(1) == 'docentes') || 
                                      (request()->segment(1) == 'cursos') ||
                                      (request()->segment(1) == 'curso_x_asignatura_x_docente') ||
                                      (request()->segment(1) == 'anotaciones') ||
                                      (request()->segment(1) == 'tarea') ||
                                      (request()->segment(1) == 'tipotarea') ||
                                      (request()->segment(1) == 'referencia') 
                                    ) 
                                      ''
                                  @else
                                  collapsed
                                  @endif
                        "
                data-bs-target="#components-nav1" 
                data-bs-toggle="collapse" 
                href="#">
                <span>Mantenedores</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul 
                id="components-nav1" 
                class="nav-content @if ( (request()->segment(1) == 'asignaturas') || 
                                            (request()->segment(1) == 'docentes') || 
                                            (request()->segment(1) == 'cursos')   ||
                                            (request()->segment(1) == 'curso_x_asignatura_x_docente') ||
                                            (request()->segment(1) == 'anotaciones') ||
                                            (request()->segment(1) == 'tarea') ||
                                            (request()->segment(1) == 'tipotarea') ||
                                            (request()->segment(1) == 'referencia') 
                                        ) 
                                            collapse show
                                        @else
                                          collapse
                                        @endif
                                        "
                data-bs-parent="#sidebar-nav">

                @can('admin-asignatura-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'asignaturas') ? '' : 'collapsed' }}" href="{{route('admin.asignaturas.index')}}" >
                      <i class="bi bi-book"></i>
                      <span>Asignaturas</span>
                    </a>
                  </li>
                @endcan

                @can('admin-docentes-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'docentes') ? '' : 'collapsed' }}" href="{{route('admin.docentes.index')}}" >
                    
                      <i class="bi bi-person-fill"></i>
                      <span>Docentes</span>
                    </a>
                  </li>
                @endcan

                @can('admin-cursos-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'cursos') ? '' : 'collapsed' }}" href="{{route('admin.cursos.index')}}" >
                    
                      <i class="bi bi-person-rolodex"></i>
                      <span>Cursos</span>
                    </a>
                  </li>
                @endcan

                @can('admin-cursos-x-asignaturas-x-docentes-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'curso_x_asignatura_x_docente') ? '' : 'collapsed' }}" href="{{route('admin.curso_x_asignatura_x_docente.index')}}" >
                    
                      <i class="bi bi-bezier"></i>
                      <span>Cursos-x-Asign-x-Docente</span>
                    </a>
                  </li>
                @endcan

                @can('admin-anotaciones-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'anotaciones') ? '' : 'collapsed' }}" href="{{route('admin.anotaciones.index')}}" >
                    
                      <i class="bi bi-journal"></i>
                      <span>Anotaciones</span>
                    </a>
                  </li>
                @endcan

                @can('admin-tarea-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'tarea') ? '' : 'collapsed' }}" href="{{route('admin.tarea.index')}}" >
                    
                      
                      <i class="bi bi-list-ol"></i>
                      <span>Tarea</span>
                    </a>
                  </li>
                @endcan

                @can('admin-tipotarea-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'tipotarea') ? '' : 'collapsed' }}" href="{{route('admin.tipotarea.index')}}" >
                    
                      <i class="bi bi-list-task"></i>
                      <span>Tipos de tarea</span>
                    </a>
                  </li>
                @endcan

                @can('admin-referencia-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(1) == 'referencia') ? '' : 'collapsed' }}" href="{{route('admin.referencia.index')}}" >
                    
                      
                      <i class="bi bi-journals"></i>
                      <span>Referencias</span>
                    </a>
                  </li>
                @endcan
              </ul>
            </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE MANTENEDORES --}}

      {{-- MENU DE IMPORTADORES --}}
            @if (auth()->user()->can('admin-importadores-show') )
            <li class="nav-item">
              <a 
                class="nav-link @if ( (request()->segment(2) == 'asignaturas') || 
                                      (request()->segment(2) == 'docentes') || 
                                      (request()->segment(2) == 'cursos') ||
                                      (request()->segment(2) == 'curso-x-asignatura-x-docente') 
                                      ) 
                                      ''
                                  @else
                                  collapsed
                                  @endif
                        "
                data-bs-target="#components-nav2" 
                data-bs-toggle="collapse" 
                href="#">
                <span>Importadores</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul 
                id="components-nav2" 
                class="nav-content @if ( (request()->segment(2) == 'asignaturas') || 
                                            (request()->segment(2) == 'docentes') || 
                                            (request()->segment(2) == 'cursos') ||
                                            (request()->segment(2) == 'curso-x-asignatura-x-docente') 
                                        ) 
                                            collapse show
                                        @else
                                          collapse
                                        @endif
                                        "
                data-bs-parent="#sidebar-nav">

                @can('admin-importadores-show')
                  <li>
                    <a class="nav-link {{ (request()->segment(2) == 'asignaturas') ? '' : 'collapsed' }}" href="{{route('admin.importadores.asignaturas')}}" >
                      <i class="bi bi-book"></i>
                      <span>Asignaturas</span>
                    </a>
                  </li>
                

                
                  <li>
                    <a class="nav-link {{ (request()->segment(2) == 'docentes') ? '' : 'collapsed' }}" href="{{route('admin.importadores.docentes')}}" >
                    
                      <i class="bi bi-person-fill"></i>
                      <span>Docentes</span>
                    </a>
                  </li>
               

                
                  <li>
                    <a class="nav-link {{ (request()->segment(2) == 'cursos') ? '' : 'collapsed' }}" href="{{route('admin.importadores.cursos')}}" >
                    
                      <i class="bi bi-person-rolodex"></i>
                      <span>Cursos</span>
                    </a>
                  </li>
                

                
                  <li>
                    <a class="nav-link {{ (request()->segment(2) == 'curso-x-asignatura-x-docente') ? '' : 'collapsed' }}" href="{{route('admin.importadores.curso_x_asignatura_x_docente')}}" >
                    
                      <i class="bi bi-bezier"></i>
                      <span>Cursos-x-Asign-x-Docente</span>
                    </a>
                  </li>
                @endcan

                
              </ul>
            </li><!-- End Components Nav -->
        @endif
      {{-- FIN MENU DE IMPORTADORES --}}
    </ul>

  </aside><!-- End Sidebar-->

  @yield('contenido')
  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Madro</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  

  <!-- Template Main JS File -->
  <script src="{{asset('assets_admin/js/main.js')}}"></script>
  <script src="{{ asset('js/app.js') }}"></script>


   
  <!-- Vendor JS Files -->
  {{-- <script src="{{asset('assets_admin/vendor/jquery/jquery.min.js')}}"></script> --}}
  {{-- <script src="{{asset('assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}


  <script src="{{asset('assets_admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
  <script src="{{asset('assets_admin/vendor/fileinput/js/fileinput.min.js')}}"></script>


  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


 <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
 
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
 
 
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/es.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>






  


 

  {{-- DataTables --}}
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

  {{-- Select2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- Bs Stepper --}}
  <script src="	https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

  {{-- Bootstrap select --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-es_ES.min.js"></script>

  @include('sweetalert::alert')
  @yield('code_js')

</body>

</html>