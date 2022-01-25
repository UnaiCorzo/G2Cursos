@extends('template_user')

@section('title')
    <title>{{ __('Mis Cursos') }} | G2Cursos</title>
@endsection
@section('lang')
    @include('partials.langNav')
@endsection
@section('user_content')
    <!-- SECCIÓN CURSOS DEMO -->
    <section class="page-section seccion_cursos mt-3" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">{{ __('Mis cursos') }}</p>
            </div>
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                @foreach (auth()->user()->courses as $course)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a id="{{ "curso_" . $course->id }}"href="{{ route('course', ['id' => $course->id, 'language' => app()->getLocale()]) }}"
                                class="link_curso" id="curso">
                                <div class="imagen_card">
                                    <span class="badge badge-pill text-white bg-success items modalidad">
                                        @if (isset($course->location))
                                            {{ __('Presencial') }}
                                        @else
                                            {{ __('Online') }}
                                        @endif
                                    </span>
                                    <img class="img-fluid" src="{{ asset('images/' . $course->image . '') }}"
                                        alt="..." />
                                </div>
                                <div class="portfolio-caption">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="portfolio-caption-heading lead items titulo_curso me-2">
                                            {{ $course->name }}</div>
                                        <div class="lead bold descripcion_cursos"><i
                                                class="fas fa-check-circle check_curso"></i></div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12 p-0 docente_cursos">
                                            <p class="m-0 items">
                                                {{ $course->teacher->name . ' ' . $course->teacher->surnames }}</p>
                                        </div>

                                        <div class="col-12 p-0 valoracion d-flex justify-content-end align-items-center">
                                            <p class="m-0 me-1 pt-1 items">{{ $course->ratings()->average('rating') }}</p>
                                            <div class="rating"
                                                value=" {{ round($course->ratings()->average('rating')) }}"></div><br>
                                            <p class="m-0 pt-1 items">({{ $course->ratings()->count() }})</p>
                                        </div>
                                        <div
                                            class="col-12 m-0 p-0 mt-3 categorias container-fluid d-flex justify-content-start align-items-center">
                                            @foreach ($course->categories as $category)
                                                <span class="badge badge-pill text-white items categorias_cursos"
                                                    id="{{ $category->id }}">{{ $category->name }}</span>
                                            @endforeach
                                            <script type="text/javascript">
                                                var categorias = <?php echo $course->categories; ?>;
                                                for (let i = 1; i <= categorias.length; i++) {
                                                    let color = categorias[i - 1].color;
                                                    var badge_categoria = document.getElementById(categorias[i - 1].id);
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
                <div class="row d-flex justify-content-center m-0 mt-4">
                    <a href="{{ route('find', app()->getLocale()) }}"
                        class="col-lg-2 col-md-4 col-sm-6 col-6 btn text-uppercase mx-2 py-2 items boton_sesion"
                        style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem; text-decoration: none; color: white;">{{ __('Descubrir más') }}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN CURSOS DEMO -->
@endsection

@section('script_link')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/rate.js') }}"></script>
@endsection
