@extends('template_user')

@section('title')
    <title>Mi Perfil | G2Cursos</title>
@endsection

@section('user_content')
    <!-- SECCIÓN PERFIL -->
    <section class="page-section seccion_perfil mt-3" id="perfil">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">Mi perfil:</p>
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
                            <button class="btn py-2 items boton_sesion d-flex justify-content-between align-items-center gap-3" id="editButton3" type="button" data-bs-toggle="modal" data-bs-target="#modal_password">
                                <i class="fas fa-lock"></i>
                                <p class="m-0 items">CAMBIAR CONTRASEÑA</p>
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-3">
                            <button class="btn submit_sesion boton_sesion py-2 items" id="modifyButton" type="submit" disabled>
                                MODIFICAR
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- FIN SECCIÓN PERFIL -->

    <!-- MODAL DE CAMBIAR CONTRASEÑA -->
    <div class="modal fade" id="modal_password">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <section class="fondo_formulario_sesion">
                    <div class="container contenedor_modal contenedor_sesion">
                        <form class="form-control formulario_sesion" id="modificar_password" method="post" name="change_password" action="/profile/reset/password">
                            {{ csrf_field() }}
                            <div class="row d-flex justify-content-start formulario_sesion">
                                <div
                                    class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                    <div class="row">
                                        <div class="col-12 mb-5 mt-2">
                                            <h2 class="section-heading m-0 text-center text-dark h3">CAMBIAR CONTRASEÑA</h2>
                                        </div>
                                        <div
                                            class="col-12 form-group px-5 d-flex justify-content-between flex-wrap mt-3 mb-3">
                                            <i class="fas fa-lock mb-2 iconos_sesion icono_formulario"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" id="password_1" type="password"
                                                    placeholder="Contraseña actual" name="password1" />
                                                    @error ('message')
                                                        <label class="error" id="error_password" for="password_1">{{ $message }}</label>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 form-group px-5 d-flex justify-content-between flex-wrap mt-3 mb-3">
                                            <i class="fas fa-lock mb-2 iconos_sesion icono_formulario"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" id="password_2" type="password"
                                                    placeholder="Nueva contraseña" name="password2" />
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 form-group px-5 d-flex justify-content-between flex-wrap mt-3 mb-3">
                                            <i class="fas fa-lock mb-2 iconos_sesion icono_formulario"></i>
                                            <div class="campos_registro">
                                                <input class="form-control p-2 campos_sesion" id="password_3" type="password"
                                                    placeholder="Repetir contraseña" name="password3" />
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-2 mb-2">
                                            <button class="btn submit_sesion boton_sesion py-2 items" id="modifyPasswordButton" type="submit">
                                                MODIFICAR
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
    <!-- FIN MODAL DE CAMBIAR CONTRASEÑA -->
@endsection

@section('script_link')
    <script src="js/profile.js"></script>
@endsection
</body>
</html>
