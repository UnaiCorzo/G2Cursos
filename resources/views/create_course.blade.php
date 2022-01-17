@extends('template_user')

@section('title')
    <title>{{ __('Creador de cursos') }} | G2Cursos</title>
@endsection

@section('user_content')
    <!-- SECCIÓN CREADOR CURSOS -->
    <section class="page-section seccion_cursos mt-3" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">{{ __('Creador de cursos') }}</p>
            </div>
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                <div class="col-12 mb-5 d-flex justify-content-between align-items-center">
                    <form action="" method="post" class="row">
                        {{ csrf_field() }}

                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion" type="text" name="name" placeholder="{{ __('Nombre curso') }}"/>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start">
                            <i class="fas fa-images mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_sesion">
                                <label class="form-file-label items mb-1" for="image">{{ __('Imagen del curso') }}</label>
                                <div class="campos_registro">
                                    <input class="form-control-file items archivo" type="file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-hand-holding-usd mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion" type="text" name="price" placeholder="{{ __('Precio curso') }}"/>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion" type="text" name="descripcion" placeholder="{{ __('Descripcion curso') }}"/>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex flex-column justify-content-start align-items-start gap-3" id="nombre">
                            <p class="m-0">Selecciona las categorías</p>
                            <div class="selector_cat">
                                <span class="badge badge-pill text-white items categorias_crear bg-secondary">PHP</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-success">JAVA</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-danger">LARAVEL</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-secondary">DOCKER</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-success">AWS</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-danger">JS</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-secondary">JQUERY</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-success">CSS</span>
                                <span class="badge badge-pill text-white items categorias_crear bg-danger">HTML</span>
                            </div>
                            <input type="hidden" name="categories" id="categories" value="">
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center text-center mt-3">
                            <button class="btn submit_sesion boton_sesion py-2 items text-uppercase"
                                id="submitButton" type="submit">{{ __('Crear') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN CREADOR CURSOS -->
@endsection

@section('script_link')
    <script src="{{ asset('js/create.js') }}"></script>
@endsection