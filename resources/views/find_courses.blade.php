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
                        <input type="text" name="course_name" id="course_name"
                            placeholder="{{ __('Nombre del curso...') }}">
                    </div>
                    <button class="btn text-uppercase mx-2 py-2 items boton_sesion boton_busqueda"
                        style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                        {{ __('Filtros') }}
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
                <div class="col-12 mb-5 filtros">
                    <div class="opciones_filtros">
                        <div class="precio">
                            <div class="titulo_filtro">
                                <p class="m-0">{{ __('Rango de precio') }}</p>
                                <div class="info_crear_curso top">
                                    <i class="fas fa-info-circle"> </i>
                                    <p>{{ __('Especifica el rango de precio en el que quieres buscar (máximo y mínimo)') }}
                                    </p>
                                </div>
                            </div>
                            <div class="max_min">
                                <input type="number" name="max" id="max" class="form-control" placeholder="max">
                                <input type="number" name="min" id="min" class="form-control" placeholder="min">
                            </div>
                        </div>
                        <div class="modalidad_filtro">
                            <div class="titulo_filtro">
                                <p class="m-0">{{ __('Modalidad') }}</p>
                                <div class="info_crear_curso top">
                                    <i class="fas fa-info-circle"> </i>
                                    <p>{{ __('Elige la modalidad de asistencia al curso (online o presencial)') }}</p>
                                </div>
                            </div>
                            <select class="form-select modalidad_select">
                                <option value="default" selected>{{ __('Cualquiera') }}</option>
                                <option value="presencial">{{ __('Presencial') }}</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                    </div>
                    <div class="categorias_filtros">
                        <div class="titulo_filtro">
                            <p class="m-0">{{ __('Categorías') }}</p>
                            <div class="info_crear_curso top">
                                <i class="fas fa-info-circle"> </i>
                                <p>{{ __('Selecciona las categorías o tags que quieres que tenga el curso que buscas') }}
                                </p>
                            </div>
                        </div>

                        @foreach ($categories as $category)
                            <span class="badge badge-pill text-white items categorias_crear"
                                id="{{ $category->id }}">{{ $category->name }}</span>
                        @endforeach
                        <script>
                            var categorias2 = <?php echo $categories; ?>;
                            for (let i = 1; i <= categorias2.length; i++) {
                                let color = categorias2[i - 1].color;
                                const badge_categoria = document.getElementById(i);
                                badge_categoria.style.background = color;
                            }
                        </script>
                    </div>
                    <div class="aplicar">
                        <button class="btn text-uppercase mx-2 py-2 items boton_sesion"
                            style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;" id="aplicar">
                            {{ __('Aplicar') }}
                        </button>
                    </div>
                </div>
                <div class="no_coincidencias">
                    <p class="m-0 text-uppercase">{{ __('¡Lo siento! No se encontraron coincidencias') }}</p>
                    <i class="far fa-frown"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCIÓN BUSCADOR CURSOS -->
@endsection

@section('script_link')
    <script src="{{ asset('js/find.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
