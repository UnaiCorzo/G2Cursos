@extends('template_user')

@section('title')
    <title>{{ __('Buscador de cursos') }} | G2Cursos</title>
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')
    <!-- SECCIÓN BUSCADOR CURSOS -->
    <section class="page-section seccion_cursos mt-5" id="cursos">
        <div class="container mt-0">
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0" id="cursos_mostrar">
                <div class="col-12 mb-5 d-flex justify-content-between align-items-center">
                    <div class="input_busqueda">
                        <i class="fas fa-search"></i>
                        <input type="text" name="course_name" id="course_name" placeholder="{{ __('Nombre del curso...') }}">
                    </div>
                    <button class="btn text-uppercase mx-2 py-2 items boton_sesion boton_busqueda" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                        {{ __('Filtros') }}
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
                <!-- <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a href="" class="link_curso" id="curso">
                            <div class="imagen_card">
                                <span class="badge badge-pill text-white bg-success items modalidad">{{ __('Presencial') }}</span>
                                <img class="img-fluid" src="{{ asset('assets/img/laravel.png') }}" alt="..."/>
                            </div>
                            <div class="portfolio-caption">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="portfolio-caption-heading lead items titulo_curso me-2">Laravel desde 0</div>
                                    <div class="lead bold descripcion_cursos"><i class="fas fa-check-circle check_curso"></i></div>
                                </div>
                                <div class="row m-0 p-0">
                                    <div class="col-12 p-0 docente_cursos">
                                        <p class="m-0 items">Alberto Ramírez (Backskills)</p>
                                    </div>

                                    <div class="col-12 p-0 valoracion">
                                        <p class="m-0 me-1 pt-1 items">3.5</p>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i><br>
                                        <p class="m-0 pt-1 items">(52)</p>
                                    </div>
                                    <div class="col-12 m-0 p-0 mt-2 categorias">
                                        <span class="badge badge-pill text-white items categorias_cursos bg-info">PHP</span>
                                        <span class="badge badge-pill text-white items categorias_cursos bg-warning">Laravel</span>
                                        <span class="badge badge-pill text-white items categorias_cursos bg-success">Backend</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN BUSCADOR CURSOS -->
@endsection

@section('script_link')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/find.js') }}"></script>
@endsection