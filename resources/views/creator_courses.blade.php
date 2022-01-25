@extends('template_user')

@section('title')
    <title>{{ __('Cursos creados') }} | G2Cursos</title>
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')
    <!-- SECCIÓN MIS CURSOS -->
    <section class="page-section seccion_cursos mt-3" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">{{ __('Cursos creados') }}</p>
            </div>
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                @if (count($courses) == 0)
                    <div class="d-flex flex-column justify-content-center align-items-center gap-5">
                        {{ __('Todavía no has creado ningún curso') }}
                        <a class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem; color: white!important;" href="{{ route('create', app()->getLocale()) }}">
                            {{ __('Crear curso') }}
                        </a>
                    </div>
                @endif
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a href="{{ route('edit_course', array(app()->getLocale(), $course->id)) }}" class="link_curso" id="{{ $course->id }}">
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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="portfolio-caption-heading lead items titulo_curso me-2">{{ $course->name }}</div>
                                        <div class="lead bold descripcion_cursos"><i class="fas fa-edit check_curso"></i></div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12 p-0 docente_cursos">
                                            <p class="m-0 items">{{ $course->teacher->name . " " . $course->teacher->surnames }}</p>
                                        </div>

                                        <div class="col-12 p-0 valoracion">
                                            <p class="m-0 me-1 pt-1 items">{{ $course->ratings()->average('rating') }}</p>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i><br>
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
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN MIS CURSOS -->
@endsection

@section('script_link')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection