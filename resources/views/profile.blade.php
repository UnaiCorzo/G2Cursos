<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>G2Cursos</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">

    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="userNav">
        <div class="container-fluid">
            <p class="h3 ms-lg-5 mb-0"><a href="index.html" style="text-decoration: none;">G2Cursos</a></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse p-0" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto me-lg-5 p2-2 py-lg-0 text-center">
                    <li class="nav-item d-flex justify-content-center align-items-center me-1">
                        <button class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;"  data-bs-toggle="modal" data-bs-target="#modal_creador">
                            HAZTE CREADOR
                        </button>
                    </li>
                    <li class="nav-item d-flex justify-content-center align-items-center"><a class="nav-link" href="#">Buscador</a></li>
                    <li class="nav-item d-flex justify-content-center align-items-center ms-2">
                        <div class="dropdown d-flex justify-content-between align-items-center gap-3 icono_perfil">
                            <button type="button" class="btn d-flex justify-content-between align-items-center p-0 gap-3" data-bs-toggle="dropdown">
                                <p class="m-0 items text-dark">{{ auth()->user()->name}} {{ auth()->user()->surnames}}</p>
                                <img src="assets/img/perfil.jpg" alt="perfil" class="rounded-circle border border-1 border-dark" width="50px;">
                            </button>
                            <div class="dropdown-menu mt-3 p-2" style="width: 100%; min-width: 200px;" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item items text-end opciones_perfil" href="/logged"><i class="fas fa-clipboard-list"></i>Mis Cursos</a>
                                <a class="dropdown-item items text-end opciones_perfil link_activo" href="/profile"><i class="fas fa-user-alt"></i>Mi Perfil</a>
                                <a class="dropdown-item items text-end opciones_perfil" href="/logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
                            </div>
                          </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN BARRA DE NAVEGACIÓN -->

    <!-- MODAL DE INICIAR SESIÓN -->
    <div class="modal fade" id="modal_creador">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <section class="fondo_formulario_sesion">
                    <div class="container contenedor_modal contenedor_sesion">
                        <form class="form-control formulario_sesion">
                            <div class="row d-flex justify-content-start formulario_sesion">
                                <div class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h2 class="section-heading m-0 text-center text-dark h3">HACERSE CREADOR</h2>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-4 d-flex justify-content-start align-items-center gap-3">
                                            <i class="fas fa-file-pdf iconos_sesion"></i>
                                            <div class="campos_sesion">
                                                <label class="form-file-label items mb-1" for="curriculum">Inserta tu CV:</label>
                                                <input class="form-control-file items" type="file" id="curriculum" name="curiculum">
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 mb-5 d-flex justify-content-start align-items-center gap-3">
                                            <i class="fas fa-building iconos_sesion"></i>
                                            <div class="form-check form-switch items campos_sesion">
                                                <input class="form-check-input empresa" type="checkbox" id="mySwitch" name="empresa" value="no">
                                                <label class="form-check-label" for="mySwitch">Pertenezco a una empresa</label>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group px-5 py-2 mb-2 d-none justify-content-between align-items-center" id="nombre">
                                            <i class="fas fa-sign mb-2 mt-1 iconos_sesion"></i>
                                            <input class="form-control p-2 campos_sesion" type="text" name="nombre" placeholder="Nombre empresa"/>
                                        </div>
                                        <div class="col-12 form-group px-5 py-2 mb-2 d-none justify-content-between align-items-center" id="direccion">
                                            <i class="fas fa-map-marked-alt mb-2 mt-1 iconos_sesion"></i>
                                            <input class="form-control p-2 campos_sesion" type="text" name="direccion" placeholder="Dirección empresa"/>
                                        </div>
                                        <div class="col-12 form-group px-5 py-2 mb-2 d-none justify-content-between align-items-center" id="localidad">
                                            <i class="fas fa-map-marker-alt mb-2 mt-1 iconos_sesion"></i>
                                            <input class="form-control p-2 campos_sesion" type="text" name="localidad" placeholder="Localidad"/>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-3">
                                            <button class="btn submit_sesion boton_sesion py-2 items"
                                                id="submitButton" type="submit">ENVIAR
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
    <!-- FIN MODAL DE INICIAR SESIÓN -->

    <!-- SECCIÓN PERFIL -->
    <section class="page-section seccion_perfil mt-3" id="perfil">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">Información personal:</p>
            </div>
            <form class="form-control" id="modificar_perfil" method="post" action="/profile/modify/{{ auth()->user()->id }}">
                {{ csrf_field() }}
                <div class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb-1 d-flex justify-content-between align-items-start gap-2" id="nombre_perfil">
                            <i class="fas fa-user iconos_perfil"></i>
                            <div class="campos_perfil">
                                <input class="form-control p-2 items" type="text" name="name" placeholder="Nombre" value="{{ auth()->user()->name }}" disabled/>
                            </div>
                            <button class="btn py-2 items boton_editar" id="editButton1" type="button">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb-1 d-flex justify-content-between align-items-start gap-2" id="apellidos_pefil">
                            <i class="fas fa-user iconos_perfil"></i>
                            <div class="campos_perfil">
                                <input class="form-control p-2 items" type="text" name="surnames" placeholder="Apellidos" value="{{ auth()->user()->surnames }}" disabled/>
                            </div>
                            <button class="btn py-2 items boton_editar" id="editButton2" type="button">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb-1 d-flex justify-content-between align-items-start gap-2" id="email_pefil">
                            <i class="fas fa-envelope iconos_perfil"></i>
                            <div class="campos_perfil">
                                <input class="form-control p-2 items" type="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" disabled/>
                            </div>
                            <button class="btn py-2 items boton_editar" id="editButton4" type="button">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb-1 d-flex justify-content-end align-items-start gap-2" id="dni_pefil">
                            <button class="btn py-2 items boton_editar d-flex justify-content-between align-items-center gap-3" id="editButton3" type="button">
                                <i class="fas fa-lock"></i>
                                <p class="m-0 items">CAMBIAR CONTRASEÑA</p>
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-3">
                            <button class="btn submit_sesion boton_sesion py-2 items" id="modifyButton" type="submit" disabled>MODIFICAR
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- FIN SECCIÓN PERFIL -->

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
                    <a class="link-dark text-decoration-none me-3" href="#!">Política de Privacidad</a>
                    <a class="link-dark text-decoration-none" href="#!">Términos de Uso</a>
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
    <script src="js/profile.js"></script>
    
</body>
</html>