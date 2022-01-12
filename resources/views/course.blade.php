@extends('template_user')

@section('title')
    <title>{{ __('Curso') }} | G2Cursos</title>
@endsection

@section('user_content')
    <!-- SECCIÓN CURSO DETALLADO -->
    <section class="page-section seccion_cursos mt-5" id="curso">
        <div class="container mt-0">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="row px-3">
                        <div class="col-8 p-0">
                            <div class="portfolio-caption-heading lead items titulo_curso">Laravel desde 0</div>
                        </div>
                        <div class="col-4 p-0">
                            <!-- IF PARA MOSTRAR EL PRECIO O ICONO SEGÚN SE ESTÉ SUSCRITO O NO -->
                            <div class="d-flex justify-content-end lead"><i class="fas fa-check-circle check_curso"></i></div>
                        </div>
                        <div class="col-12 descripcion_larga mt-3 mb-3 p-0">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem labore suscipit minus magni laboriosam voluptatibus recusandae omnis fugit fuga reprehenderit ipsam, ab earum nulla error libero incidunt nostrum pariatur! Rem?
                            Fuga cumque iusto possimus, nostrum nisi molestias perspiciatis! Quibusdam ea quasi modi, id architecto rem dignissimos. Consequuntur assumenda laudantium a voluptatem maiores quaerat architecto ipsam, natus doloremque, molestias rem! Placeat?
                            Quae, sit! Temporibus dolor eos aut sapiente illum! Rem hic, libero maxime illo, necessitatibus porro nisi in laboriosam aspernatur, voluptatibus qui consectetur? Eos enim aut explicabo cupiditate aperiam quod voluptatum?
                        </div>
                        <div class="col-6 d-flex justify-content-start align-items-end docente_cursos p-0">
                            <p class="m-0 items creador_curso">Alberto Ramírez (Backskills)</p>
                        </div>
                        <div class="col-6 p-0 valoracion d-flex justify-content-end align-items-center">
                            <p class="m-0 me-1 pt-1 items">3.5</p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i><br>
                            <p class="m-0 pt-1 items">(52)</p>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <button class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                            {{ __('Quitar') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 order-lg-last order-first mb-5 mb-lg-0">
                    <div class="row px-3">
                        <div class="col-12 imagen_card p-0">
                            <span class="badge badge-pill text-white bg-success items modalidad mod_curso">{{ __('Presencial') }}</span>
                            <img class="img-fluid img_curso" src="{{ asset('assets/img/laravel.png') }}" alt="..."/>
                        </div>
                        <div class="col-12 m-0 p-0 mt-3 categorias d-flex justify-content-end align-items-center">
                            <span class="badge badge-pill text-white items categorias_cursos bg-info">CAT1</span>
                            <span class="badge badge-pill text-white items categorias_cursos bg-warning">CAT2</span>
                            <span class="badge badge-pill text-white items categorias_cursos bg-success">CAT3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN CURSO DETALLADO -->
@endsection

@section('script_link')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/course.js') }}"></script>
@endsection