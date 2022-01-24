<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @yield('title')
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="userNav">
        <div class="container-fluid">
            <p class="h3 ms-lg-5 mb-0"><a href="{{ route('home', app()->getLocale()) }}" style="text-decoration: none;">G2Cursos</a></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                {{ __('Menú') }}
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse p-0 mt-3 mt-lg-0" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto me-lg-5 p2-2 py-lg-0 text-center">
                        @if (auth()->user()->role_id == 1)
                            <li class="nav-item d-flex justify-content-center align-items-center me-1">
                                <button class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem; color: white!important;"  data-bs-toggle="modal" data-bs-target="#modal_creador">
                                    {{ __('Hazte creador') }}
                                </button>
                            </li>
                        @elseif (auth()->user()->role_id == 3)
                            <li class="nav-item d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin', app()->getLocale()) }}" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem; color: white!important;">
                                    {{ __('Panel administrador') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item d-flex justify-content-center align-items-center">
                                <a class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem; color: white!important;" href="{{ route('create', app()->getLocale()) }}">
                                    {{ __('Crear curso') }}
                                </a>
                            </li>
                        @endif
                    <li class="nav-item d-flex justify-content-center align-items-center"><a class="nav-link opciones_menu" id="link4" href="{{ route('find', app()->getLocale()) }}">{{ __('Buscador') }}</a></li>
                    <li class="nav-item d-flex justify-content-center align-items-center ms-2">
                        <div class="dropdown d-flex justify-content-end align-items-center gap-3 icono_perfil" style="min-width: 9.5rem;">
                            <button type="button" class="btn d-flex justify-content-between align-items-center p-0 gap-3" data-bs-toggle="dropdown">
                                <p class="m-0 items text-dark">{{ auth()->user()->name}} {{ auth()->user()->surnames}}</p>
                                <img src="{{ asset('assets/img/perfil.jpg') }}" alt="perfil" class="rounded-circle border border-1 border-dark" width="50px;">
                            </button>
                            <div class="dropdown-menu mt-3 p-2" style="width: 18rem;" aria-labelledby="dropdownMenuButton">
                                @if (auth()->user()->role_id == 2)
                                    <a class="dropdown-item items text-end opciones_perfil link_activo" id="link1" href="#"><i class="fas fa-marker"></i>{{ __('Cursos creados') }}</a>
                                @endif
                                    <a class="dropdown-item items text-end opciones_perfil link_activo" id="link2" href="{{ route('home', app()->getLocale()) }}"><i class="fas fa-clipboard-list"></i>{{ __('Mis cursos') }}</a>
                                    <a class="dropdown-item items text-end opciones_perfil" id="link3" href="{{ route('profile', app()->getLocale()) }}"><i class="fas fa-user-alt"></i>{{ __('Mi perfil') }}</a>
                                    <a href="{{ route('logout', app()->getLocale()) }}" class="dropdown-item items text-end opciones_perfil"><i class="fas fa-sign-out-alt"></i>{{ __('Cerrar sesión') }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-flex justify-content-center align-items-center ms-4">
                        <select id="prueba" class="bg-secondary text-white rounded-2 p-1">
                            @yield('lang') 
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN BARRA DE NAVEGACIÓN -->

    <!-- MODAL DE HACERSE CREADOR -->
    <div class="modal fade" id="modal_creador">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <section class="fondo_formulario_sesion">
                    <div class="container contenedor_modal contenedor_sesion">
                    <form class="form-control formulario_sesion" id="hacerse_creador" method="post" action="{{ route('file', app()->getLocale()) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row d-flex justify-content-start formulario_sesion">
                                <div class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h2 class="section-heading m-0 text-center text-dark h3 text-uppercase">{{ __('Hacerse creador') }}</h2>
                                        </div>
                                        <div class="col-12 form-group px-5 d-flex justify-content-start align-items-start gap-3">
                                            <i class="fas fa-file-pdf iconos_sesion"></i>
                                            <div class="campos_sesion">
                                                <label class="form-file-label items mb-1" for="curriculum">{{ __('Inserta tu CV') }}</label>
                                                <div class="campos_registro">
                                                    <input class="form-control-file items archivo" type="file" id="file" name="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-4 d-flex justify-content-start align-items-center gap-3">
                                            <i class="fas fa-building iconos_sesion"></i>
                                            <div class="form-check form-switch items campos_sesion">
                                                <input class="form-check-input empresa" type="checkbox" id="mySwitch" name="empresa" value="no">
                                                <label class="form-check-label" for="mySwitch">{{ __('Pertenezco a una empresa') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-2 d-none justify-content-between align-items-start" id="nombre">
                                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" type="text" name="name" placeholder="{{ __('Nombre empresa') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-2 d-none justify-content-between align-items-start" id="direccion">
                                            <i class="fas fa-map-marked-alt mb-2 mt-2 iconos_sesion"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" type="text" name="address" placeholder="{{ __('Dirección empresa') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-2 d-none justify-content-between align-items-start" id="localidad">
                                            <i class="fas fa-map-marker-alt mb-2 mt-2 iconos_sesion"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" type="text" name="locality" placeholder="{{ __('Localidad') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-3">
                                            <button class="btn submit_sesion boton_sesion py-2 items text-uppercase"
                                                id="submitButton" type="submit">{{ __('Enviar') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <i class="far fa-times-circle boton_cerrar_modal" data-bs-dismiss="modal"></i>
                </section>
            </div>
        </div>
    </div>
    <!-- FIN MODAL DE HACERSE CREADOR -->

    @yield('user_content')

    <!-- PIE DE LA PÁGINA -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; G2Cursos 2022</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_twitter" href="https://www.twitter.com" target="blank"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_facebook" href="https://www.facebook.com" target="blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_linkedin" href="https://www.linkedin.com" target="blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">{{ __('Política de Privacidad') }}</a>
                    <a class="link-dark text-decoration-none" href="#!">{{ __('Términos de Uso') }}</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FIN PIE DE LA PÁGINA -->

    <!-- LINKS SCRIPTS DE BOOTSTRAP -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @yield('script_link')

</body>

</html>