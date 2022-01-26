<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>G2Cursos</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css')  }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <p class="h3 ms-lg-5 mb-0"><a href="{{ route('login', app()->getLocale()) }}"
                    style="text-decoration: none; color: #E8EEF2; text-shadow: #0B132B 1px 1px 1px;">G2Cursos</a></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                {{ __('Menú') }}
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse p-0" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto me-lg-5 p2-2 py-lg-0 text-center align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#cursos"
                            style="color: #E8EEF2; text-shadow: #0B132B 1px 1px 1px;">{{ __('Cursos') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros"
                            style="color: #E8EEF2; text-shadow: #0B132B 1px 1px 1px;">{{ __('Servicios') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact"
                            style="color: #E8EEF2; text-shadow: #0B132B 1px 1px 1px;">{{ __('Contacto') }}</a></li>
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <button class="btn text-uppercase ms-2 py-2 items boton_sesion2"
                            style="height: 100%; font-weight: bold; text-shadow: #0B132B 1px 1px 1px;"
                            data-bs-toggle="modal" data-bs-target="#modal_sesion">
                            {{ __('Iniciar sesión') }}
                        </button>
                    </li>
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <button class="btn text-uppercase ms-2 py-2 items boton_sesion"
                            style="height: 100%;font-weight: bold; text-shadow: #0B132B 1px 1px 1px;"
                            data-bs-toggle="modal" data-bs-target="#modal_registro">
                            {{ __('Registrarse') }}
                        </button>
                    </li>
                    <li class="nav-item d-flex justify-content-center align-items-center ms-2">
                        <select id="prueba" class="bg-secondary text-white rounded-2 p-1">
                            @if (app()->getLocale() == "es")
                                <option id="es" value="{{ route(Route::currentRouteName(), 'es') }}" selected>
                                    ES
                                </option>
                                <option id="en" value="{{ route(Route::currentRouteName(), 'en') }}">
                                    EN
                                </option>
                                <option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}">
                                    EU
                                </option>
                            @elseif (app()->getLocale() == "en")
                                <option id="es" value="{{ route(Route::currentRouteName(), 'es') }}">
                                    ES
                                </option>
                                <option id="en" value="{{ route(Route::currentRouteName(), 'en') }}" selected>
                                    EN
                                </option>
                                <option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}">
                                    EU
                                </option>
                            @else
                                <option id="es" value="{{ route(Route::currentRouteName(), 'es') }}">
                                    ES
                                </option>
                                <option id="en" value="{{ route(Route::currentRouteName(), 'en') }}">
                                    EN
                                </option>
                                <option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}" selected>
                                    EU
                                </option>
                            @endif
                        </select>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ALERTA DE REGISTRO COMPLETADO -->
        @if (isset($success) && !$errors->any() && $success == "true")
            <div class="alert alert-success alert-dismissible alerta_registro">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <p class="m-0">¡USUARIO VERIFICADO CORRECTAMENTE!</p><i class="fas fa-check-circle check_curso"></i>
            </div>
        @endif
        <!-- FIN ALERTA DE REGISTRO COMPLETADO -->
    </nav>
    <!-- FIN BARRA DE NAVEGACIÓN -->

    <!-- MODAL DE INICIAR SESIÓN -->
    <div class="modal fade" id="modal_sesion">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <section class="fondo_formulario_sesion">
                    <div class="container contenedor_modal contenedor_sesion">
                        <form class="form-control formulario_sesion" id="iniciar_sesion" method="post" name="signin" action="{{ route('session', app()->getLocale()) }}">
                            {{ csrf_field() }}
                            <div class="row d-flex justify-content-start formulario_sesion">
                                <div
                                    class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h2 class="section-heading m-0 text-center text-dark h3 text-uppercase">{{ __('Iniciar sesión') }}</h2>
                                        </div>
                                        <div
                                            class="col-12 form-group px-5 mt-3 d-flex justify-content-between flex-wrap">
                                            <i class="fas fa-envelope mb-2 iconos_sesion icono_formulario"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" type="email"
                                                    placeholder="Email" name="email" />
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 form-group px-5 d-flex justify-content-between flex-wrap mt-3 mb-3">
                                            <i class="fas fa-lock mb-2 iconos_sesion icono_formulario"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" type="password"
                                                    placeholder="{{ __('Contraseña') }}" name="password" id="password_sesion"/>
                                                    @error ('message')
                                                        <label class="error" id="error_sesion" for="password_sesion">{{ $message }}</label>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 d-flex justify-content-between align-items-end px-5 text-center mt-3 mb-4">
                                            <a href="#" class="registrarse_sesion items ms-5" data-bs-toggle="modal"
                                                data-bs-target="#modal_registro">{{ __('Registrarse') }}</a>
                                            <button class="btn submit_sesion boton_sesion py-2 items me-5 text-uppercase"
                                                 type="submit">{{ __('Entrar') }}
                                            </button>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center align-items-end px-5 text-center mt-3">
                                            <a href="{{ route('password.request', app()->getLocale()) }}" class="registrarse_sesion items">{{ __('Recuperar contraseña') }}</a>
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

    <!-- MODAL DE REGISTRARSE -->
    <div class="modal fade" id="modal_registro">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <section class="fondo_formulario_registro">
                    <div class="container contenedor_modal contenedor_registro">
                        <form class="form-control formulario_registro" id="registrarse" method="post" action="{{ route('user', app()->getLocale()) }}">
                            {{ csrf_field() }}
                            <div class="row d-flex justify-content-start formulario_registro">
                                <div
                                    class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h2 class="section-heading m-0 text-center text-dark h3 text-uppercase">{{ __('Registrarse') }}</h2>
                                        </div>
                                        <div class="col-lg-6 col-12 px-5">
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-user iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="text" placeholder="{{ __('Nombre') }}"
                                                        name="name" />
                                                </div>
                                            </div>
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-user iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="text" placeholder="{{ __('Apellidos') }}"
                                                        name="surnames" />
                                                </div>
                                            </div>
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-id-card iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="text" id="dni_registro" placeholder="{{ __('DNI') }}"
                                                        name="dni" />
                                                        @error ('message_dni')
                                                            <label class="error" id="error_registro" for="dni_registro">{{ $message }}</label>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 px-5 ps-lg-0 ps-5">
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-envelope iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="email" id="email_registro" placeholder="Email"
                                                        name="email" />
                                                        @error ('message_email')
                                                            <label class="error" id="error_registro" for="email_registro">{{ $message }}</label>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-lock iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="password"
                                                        placeholder="{{ __('Contraseña') }}" id="password_1" name="password1" />
                                                </div>
                                            </div>
                                            <div class="col-12 form-group mb-1 d-flex justify-content-between">
                                                <i class="fas fa-lock iconos_registro icono_formulario"></i>
                                                <div class="campos_registro">
                                                    <input class="form-control p-2" type="password"
                                                        placeholder="{{ __('Repetir contraseña') }}" id="password_2"
                                                        name="password2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 d-flex justify-content-between px-5 align-items-end text-center mt-3">
                                            <a href="#" class="sesion_registro items ms-3" data-bs-toggle="modal"
                                                data-bs-target="#modal_sesion">{{ __('Iniciar sesión') }}</a>
                                            <button class="btn submit_registro boton_sesion py-2 items me-3 text-uppercase"
                                             type="submit">{{ __('Entrar') }}
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
    <!-- FIN MODAL DE REGISTRARSE -->

    <!-- CABECERA ESLOGAN Y BOTÓN COMENZAR -->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading" style="text-shadow: #0B132B 2px 2px 5px;">{{ __('Empieza a aprender') }}</div>
            <div class="masthead-heading text-uppercase" style="text-shadow: #0B132B 2px 2px 5px;">
                {{ __('Conectando el conocimiento') }}
            </div>
            <a class="btn btn-xl text-uppercase boton_sesion boton_ver_cursos" href="#cursos">{{ __('Ver cursos') }}<i
                    class="fas fa-arrow-down ms-3"></i></a>
        </div>
    </header>
    <!-- FIN CABECERA ESLOGAN Y BOTÓN COMENZAR -->

    <!-- SECCIÓN CURSOS DEMO -->
    <section class="page-section seccion_cursos" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ __('Cursos') }}</h2>
                <h3 class="section-subheading text-muted">{{ __('Descubre los cursos más destacados') }}</h3>
            </div>
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                @foreach ($courses as $course)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item" id="curso_{{ $course->id }}" data-bs-toggle="modal" data-bs-target="#modal_registro">
                        <div class="imagen_card">
                            <span class="badge badge-pill text-white bg-success items modalidad">
                                @if (!is_null($course->location))
                                    {{ __('Presencial') }}
                                @else
                                     Online
                                @endif
                            </span>
                            <img class="img-fluid" src="/images/{{ $course->image }}" alt="{{ $course->name }}"/>
                        </div>
                        <div class="portfolio-caption">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <div class="portfolio-caption-heading lead items titulo_curso me-2">{{ $course->name }}</div>
                                <div class="lead bold descripcion_cursos text-uppercase">
                                    @if ($course->price > 0)
                                        {{ $course->price . '€' }}
                                    @else
                                        {{ __('Gratis') }}
                                    @endif
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-12 p-0 docente_cursos">
                                    <p class="m-0 items">{{ $course->teacher->name . " " . $course->teacher->surnames }}</p>
                                </div>
                                <div class="col-12 p-0 valoracion">
                                    <p class="m-0 me-1 pt-1 items">{{ $course->ratings()->average('rating') }}</p>
                                    <div class="rating" value=" {{ round($course->ratings()->average('rating')) }}"></div><br>
                                    <p class="m-0 pt-1 items">({{ $course->ratings()->count() }})</p>
                                </div>
                                <div class="col-12 m-0 p-0 mt-2 categorias">
                                    @foreach ($course->categories as $category)
                                        <span class="badge badge-pill text-white items categorias_cursos" id="{{ $course->name . '_' . $category->id }}">{{ $category->name }}</span>
                                    @endforeach
                                    <script>
                                        var course = <?php echo $course ?>;
                                        var categorias = <?php echo $course->categories ?>;
                                        for (let i = 1; i <= categorias.length; i++) {
                                            let color = categorias[i - 1].color;
                                            var badge_categoria = document.getElementById(course.name + "_" + categorias[i - 1].id);
                                            badge_categoria.style.background = color;
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row d-flex justify-content-center m-0 mt-4">
                    <div class="col-lg-2 col-md-3 col-sm-3 py-2 px-1 btn mt-2 ms-sm-2 items boton_ver_mas boton_sesion text-uppercase"
                        data-bs-toggle="modal" data-bs-target="#modal_sesion">{{ __('Ver más') }}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN CURSOS DEMO -->

    <!-- SECCIÓN SERVICIOS -->
    <section class="page-section seccion_servicios" id="nosotros">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ __('Servicios') }}</h2>
                <h3 class="section-subheading text-muted">{{ __('Disfruta de nuestra oferta de servicios') }}</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x iconos_servicios">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-chalkboard-teacher fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 titulo_servicios">{{ __('Crear') }}</h4>
                    <p class="text-muted texto_servicios mb-5">
                        {{ __('Hazte creador de cursos y contribuye a conectar el conocimiento de una manera sencilla y rápida') }}
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x iconos_servicios">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 titulo_servicios">{{ __('Usabilidad') }}</h4>
                    <p class="text-muted texto_servicios mb-5">
                        {{ __('Gracias a nuestro buscador y filtros encontrarás los cursos que más te interesan rápidamente') }}
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x iconos_servicios">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="far fa-gem fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 titulo_servicios">{{ __('Ventajas') }}</h4>
                    <p class="text-muted texto_servicios mb-5">
                        {{ __('Con nosotros obtendrás ventajas y descuentos exclusivos en los cursos') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN SERVICIOS -->

    <!-- SECCIÓN CONTACTO -->
    <section class="page-section seccion_contacto" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{ __('Contacto') }}</h2>
                <h3 class="section-subheading text-muted">{{ __('¿Tienes alguna duda o sugerencia?') }}</h3>
            </div>
            <form id="contactForm" method="post" action="{{ route('contact_send', app()->getLocale()) }}">
                {{ csrf_field() }}
                <div class="row d-flex justify-content-center align-items-stretch mb-5 formulario_contacto">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group px-1 d-flex justify-content-between gap-md-3">
                            <i class="fas fa-user mb-2 iconos_contacto"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_contacto" type="text" name="name" placeholder="{{ __('Nombre') }}" />
                            </div>
                        </div>
                        <div class="form-group px-1 d-flex justify-content-between gap-md-3">
                            <i class="fas fa-envelope mb-2 iconos_contacto"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_contacto" type="email" name="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group px-1 d-flex justify-content-between gap-md-3">
                            <i class="fas fa-phone mb-2 iconos_contacto"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_contacto" type="text" name="phone" placeholder="{{ __('Teléfono') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group px-1 d-flex justify-content-between gap-md-3">
                            <i class="fas fa-comments mb-2 iconos_contacto"></i>
                            <div class="campos_registro">
                                <textarea class="form-control p-2 campos_contacto" id="message" name="comments" placeholder="{{ __('Comentarios') }}"
                                rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center"><button class="btn boton_sesion boton_contacto items p-2 px-4 text-uppercase"
                        type="submit">{{ __('Enviar') }}</button></div>
            </form>
        </div>
    </section>
    <!-- FIN SECCIÓN CONTACTO -->

    <!-- PIE DE LA PÁGINA -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; G2Cursos 2022</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_twitter" href="https://www.twitter.com"
                        target="blank"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_facebook" href="https://www.facebook.com"
                        target="blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2 iconos_footer icono_linkedin" href="https://www.linkedin.com"
                        target="blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">{{ __('Política de Privacidad') }}</a>
                    <a class="link-dark text-decoration-none" href="#!">{{ __('Términos de Uso') }}</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FIN PIE DE LA PÁGINA -->

    <!-- COOKIES -->
    <div class="cookies">
        <div class="texto_cookies">
            <p class="items m-0">{{ __('Esta página utiliza cookies, acéptalas para seguir navegando.') }}</p>
            <a href="http://www.interior.gob.es/politica-de-cookies" target="_blank" class="items">{{ __('Más información') }}</a>
        </div>
        <div class="boton_cookie">
            <button class="btn items boton_sesion">{{ __('Aceptar') }}</button>
        </div>
        <div class="cerrar_cookies">
            <i class="far fa-times-circle"></i>
        </div>
    </div>
    <!-- FIN COOKIES -->

    <!-- LINKS SCRIPTS DE BOOTSTRAP -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
