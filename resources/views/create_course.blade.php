@extends('template_user')

@section('title')
    <title>{{ __('Crear curso') }} | G2Cursos</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')
    <!-- SECCIÓN CREADOR CURSOS -->
    <section class="page-section seccion_cursos mt-3" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">{{ __('Crear curso') }}</p>
            </div>
            <div class="row mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                <div class="col-12 mb-5 d-flex justify-content-between align-items-center">
                    <form action="{{ route('course-store', app()->getLocale()) }}" method="post" class="row align-content-start" id="crear_curso" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion" type="text" id="name" name="name" placeholder="{{ __('Título curso') }}"/>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start">
                            <i class="fas fa-images mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_sesion">
                                <label class="form-file-label items mb-1" for="image">{{ __('Imagen curso') }}</label>
                                <div class="campos_registro">
                                    <input class="form-control-file items archivo" type="file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-hand-holding-usd mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion" type="number" id="price" step="0.01" name="price" placeholder="{{ __('Precio curso') }}"/>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-start" id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro_area">
                                <textarea class="form-control p-2 campos_sesion" rows="5" id="description" name="description" placeholder="{{ __('Descripción curso') }}" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex flex-column justify-content-start align-items-start gap-3" id="nombre">
                            <div class="titulo_crear">
                                <p class="m-0">{{ __('Selecciona las categorías:') }}</p>
                                <div class="info_crear_curso top">
                                    <i class="fas fa-info-circle"> </i>
                                    <p>{{ __('Categorías o tags que se relacionarán con el curso. Debes seleccionar mínimo una y como máximo cinco.') }}</p>
                                </div>
                            </div>
                            <div class="selector_cat mt-2">
                                @foreach ($categories as $category)
                                    <span class="badge badge-pill text-white items categorias_crear" id="{{ $category->id }}">{{ $category->name }}</span>
                                @endforeach
                                <script>
                                    const categorias = <?php echo $categories ?>;
                                    for (let i = 1; i <= categorias.length; i++) {
                                        let color = categorias[i - 1].color;
                                        const badge_categoria = document.getElementById(i);
                                        badge_categoria.style.background = color;
                                    }
                                </script>
                            </div>
                            <div class="campos_registro">
                                <input type="hidden" name="categories" id="categories" value="">
                            </div>
                        </div>
                        <div class="col-6 form-group px-5 mb-2 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <i class="fas fa-street-view iconos_sesion"></i>
                            <div class="form-check form-switch items campos_sesion">
                                <input class="form-check-input presencial me-2" type="checkbox" id="switchPresencial" name="presencial" value="no">
                                <div class="titulo_crear">
                                    <p class="m-0">{{ __('Presencial') }}</p>
                                    <div class="info_crear_curso top">
                                        <i class="fas fa-info-circle"> </i>
                                        <p>{{ __('Acciona este switch si el curso va a tener la modalidad presencial. Debes seleccionar una ubicación en el mapa.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="map mt-2" id="map" style="width: 100%; height: 300px;"></div>
                            <div class="campos_registro">
                                <input type="hidden" value="" name="location" id="location">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
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
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
@endsection
