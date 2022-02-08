@extends('template_user')

@section('title')
    <title>{{ __('Crear curso') }} | G2Cursos</title>
@endsection

@section('lang')
    @if (app()->getLocale() == 'es')
        <option id="es" value=" {{ route(Route::currentRouteName(), ['language' => 'es', 'id' => $course->id]) }}"
            selected>
            ES
        </option>
        <option id="en" value="{{ route(Route::currentRouteName(), ['language' => 'en', 'id' => $course->id]) }}">
            EN
        </option>
        <option id="eu" value="{{ route(Route::currentRouteName(), ['language' => 'eu', 'id' => $course->id]) }} ">
            EU
        </option>
    @elseif (app()->getLocale() == 'en')
        <option id="es" value=" {{ route(Route::currentRouteName(), ['language' => 'es', 'id' => $course->id]) }}">
            ES
        </option>
        <option id="en" value=" {{ route(Route::currentRouteName(), ['language' => 'en', 'id' => $course->id]) }}"
            selected>
            EN
        </option>
        <option id="eu" value=" {{ route(Route::currentRouteName(), ['language' => 'eu', 'id' => $course->id]) }}">
            EU
        </option>
    @else
        <option id="es" value="{{ route(Route::currentRouteName(), ['language' => 'es', 'id' => $course->id]) }}">
            ES
        </option>
        <option id="en" value="{{ route(Route::currentRouteName(), ['language' => 'en', 'id' => $course->id]) }}">
            EN
        </option>
        <option id="eu" value="{{ route(Route::currentRouteName(), ['language' => 'eu', 'id' => $course->id]) }}"
            selected>
            EU
        </option>
    @endif
@endsection

@section('user_content')
    <!-- SECCIÓN CREADOR CURSOS -->
    <section class="page-section seccion_cursos mt-3" id="cursos">
        <div class="container mt-0">
            <div class="text-center">
                <p class="h5 items mb-5 mt-2">{{ __('Modificar curso') }}</p>
            </div>
            <form action="{{ route('course-modify', [app()->getLocale(), $course->id]) }}" method="post"
                class="row p-3" id="crear_curso" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-12 mx-0 mx-lg-4 mx-md-4 mx-sm-0 mx-md-0 mx-lg-0 seccion_crear px-3 pt-5">
                    <div class="row mb-5 p-3">
                        <input type="hidden" name="id" value="{{ $course->id }}">

                        <div class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex justify-content-between align-items-start"
                            id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion campos_crear" type="text" id="name" name="name"
                                    placeholder="{{ __('Título curso') }}" value="{{ $course->name }}" />
                            </div>
                        </div>
                        <div
                            class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex justify-content-between align-items-start">
                            <i class="fas fa-images mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_sesion">
                                <label class="form-file-label items mb-1" for="image">{{ __('Imagen curso') }}</label>
                                <div class="campos_registro">
                                    <input class="form-control-file items archivo campos_crear" type="file" id="image"
                                        name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex justify-content-between align-items-start"
                            id="nombre">
                            <i class="fas fa-hand-holding-usd mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro">
                                <input class="form-control p-2 campos_sesion campos_crear" type="number" id="price"
                                    step="0.01" name="price" placeholder="{{ __('Precio curso') }}"
                                    value="{{ $course->price }}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex justify-content-between align-items-start"
                            id="nombre">
                            <i class="fas fa-sign mb-2 mt-2 iconos_sesion"></i>
                            <div class="campos_registro_area">
                                <textarea class="form-control p-2 campos_sesion campos_crear" rows="5" id="description"
                                    name="description" placeholder="{{ __('Descripción curso') }}"
                                    style="resize: none;">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex flex-column justify-content-start align-items-start gap-3"
                            id="nombre">
                            <div class="titulo_crear">
                                <p class="m-0">{{ __('Selecciona las categorías:') }}</p>
                                <div class="info_crear_curso top">
                                    <i class="fas fa-info-circle"> </i>
                                    <p>{{ __('Categorías o tags que se relacionarán con el curso. Debes seleccionar mínimo una y como máximo cinco.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="selector_cat mt-2">
                                @foreach ($categories as $category)
                                    <span class="badge badge-pill text-white items categorias_crear"
                                        id="{{ $category->id }}">{{ $category->name }}</span>
                                @endforeach
                                <script>
                                    const categorias = <?php echo $categories; ?>;
                                    for (let i = 1; i <= categorias.length; i++) {
                                        let color = categorias[i - 1].color;
                                        const badge_categoria = document.getElementById(i);
                                        badge_categoria.style.background = color;
                                    }
                                    var curso = <?php echo $course; ?>;
                                    var categorias_actuales = <?php echo $current_categories; ?>;
                                </script>
                            </div>
                            <div class="campos_registro">
                                <input type="hidden" name="categories" id="categories" value="">
                            </div>
                        </div>
                        <div
                            class="col-lg-6 col-12 form-group px-2 px-lg-5 px-md-5 mb-2 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <i class="fas fa-street-view iconos_sesion"></i>
                            <div class="form-check form-switch items campos_sesion">
                                <input class="form-check-input presencial me-2" type="checkbox" id="switchPresencial"
                                    name="presencial" value="no">
                                <div class="titulo_crear">
                                    <p class="m-0">{{ __('Presencial') }}</p>
                                    <div class="info_crear_curso top">
                                        <i class="fas fa-info-circle"> </i>
                                        <p>{{ __('Acciona este switch si el curso va a tener la modalidad presencial. Debes seleccionar una ubicación en el mapa.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="map mt-2" id="map" style="width: 100%; height: 300px;"></div>
                            <div class="campos_registro">
                                @if ($course->location != null)
                                    <input type="hidden" value="{{ $course->location }}" name="location" id="location">
                                @else
                                    <input type="hidden" value="{{ $course->location }}" name="location" id="location">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button class="btn submit_sesion boton_sesion py-2 items text-uppercase" id="submitButton"
                                type="submit">{{ __('Modificar') }}
                            </button>
                        </div>
                        <div class="col-12 mt-5 d-flex justify-content-end align-items-center">
                            <a href="" class="registrarse_sesion items px-5" data-bs-toggle="modal"
                                data-bs-target="#modal_eliminar_curso">{{ __('Borrar curso') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- FIN SECCIÓN CREADOR CURSOS -->

    <!-- MODAL ELIMINAR CURSO -->
    <div class="modal fade" id="modal_eliminar_curso">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header align-items-start">
                    <p class="modal-title text-danger text-center h4 items">
                        {{ __('¿Seguro que quieres borrar este curso?') }}</p>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('delete_course', [app()->getLocale(), $course->id]) }}" method="post"
                        class="col-12 d-flex justify-content-center gap-3">
                        {{ csrf_field() }}
                        <button type="submit" class="btn boton_sesion text-uppercase"
                            data-bs-dismiss="modal">{{ __('Sí') }}</button>
                        <button type="button" class="btn boton_sesion text-uppercase"
                            data-bs-dismiss="modal">{{ __('No') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ELIMINAR CURSO -->
@endsection

@section('script_link')
    <script src="{{ asset('js/edit_course.js') }}"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
@endsection
