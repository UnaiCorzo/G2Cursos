@extends('template_user')

@section('title')
<title>{{ __('Curso') }} | G2Cursos</title>
@endsection
@section('lang')
@if (app()->getLocale() == "es")
<option id="es" value=" {{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'es']) }}" selected>
    ES
</option>
<option id="en" value="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'en']) }}">
    EN
</option>
<option id="eu" value="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'eu']) }} ">
    EU
</option>
@elseif (app()->getLocale() == "en")
<option id="es" value=" {{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'es']) }}">
    ES
</option>
<option id="en" value=" {{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'en']) }}" selected>
    EN
</option>
<option id="eu" value=" {{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'eu']) }}">
    EU
</option>
@else
<option id="es" value="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'es']) }}">
    ES
</option>
<option id="en" value="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'en']) }}">
    EN
</option>
<option id="eu" value="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'eu']) }}" selected>
    EU
</option>
@endif
@endsection
@section('user_content')
<!-- SECCIÓN CURSO DETALLADO -->
<section class="page-section seccion_cursos mt-5" id="curso">
    <div class="container mt-0">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="row px-3">
                    <div class="col-8 p-0">
                        <div class="portfolio-caption-heading lead items titulo_curso">{{$course->name}}</div>
                    </div>
                    <div class="col-4 p-0">
                        <!-- IF PARA MOSTRAR EL PRECIO O ICONO SEGÚN SE ESTÉ SUSCRITO O NO -->
                        <div class="d-flex justify-content-end lead">
                            @if ($course->price == 0)
                            {{ __('Gratis') }}
                            @else
                            {{$course->price}}€
                            @endif
                            </i>
                        </div>
                    </div>
                    <div class="col-12 descripcion_larga mt-3 mb-3 p-0">
                        {{ $course->description }}
                    </div>
                    <div class="col-6 d-flex justify-content-start align-items-end docente_cursos p-0">
                        <p class="m-0 items creador_curso">{{$course->teacher->name ." " .$course->teacher->surnames}}</p>
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
                        <a href="{{ route(Route::currentRouteName(),  ['id'=>$id,'language'=> 'eu']) }}"class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                            {{ __('Quitar') }}</a>
                        <a href="{{ route('course',  ['id'=>$id,'language'=> 'eu']) }}"class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                            {{ __('Valorar') }}</a>
                        @if (isset($course->location))
                        <a href="{{ route('geolocalization',  ['id'=>$id,'language'=>  app()->getLocale() , 'coordinates'=>$course->location]) }}" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">    {{ __('Cómo llegar') }}</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12 order-lg-last order-first mb-5 mb-lg-0">
                <div class="row px-3">
                    <div class="col-12 imagen_card p-0">
                        <span class="badge badge-pill text-white bg-success items modalidad mod_curso">
                            @if (!is_null($course->location))
                            {{ __('Presencial') }}
                            @else
                            Online
                            @endif
                        </span>
                        <img class="img-fluid img_curso" src="/images/{{ $course->image }}" alt="..." />
                    </div>
                    <div class="col-12 m-0 p-0 mt-3 categorias d-flex justify-content-end align-items-center">
                        @foreach ($categories as $category)
                        <span class="badge badge-pill text-white items categorias_cursos" id="{{ $category->id }}">{{ $category->name }}</span>
                        @endforeach
                        <script>
                            var categorias = <?php echo $categories ?>;
                            for (let i = 1; i <= categorias.length; i++) {
                                let color = categorias[i - 1].color;
                                var badge_categoria = document.getElementById(categorias[i - 1].id);
                                badge_categoria.style.background = color;
                            }
                        </script>
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