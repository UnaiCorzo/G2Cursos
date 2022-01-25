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
                        <p class="m-0 me-1 pt-1 items">{{ $ratings->average('rating') }}</p>
                        <div class="rating" value=" {{round($ratings->average('rating'))}}"></div><br>
                        <p class="m-0 pt-1 items">({{ $ratings->count() }})</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5">
                        @if ($subscribed)
                        <a href="{{ route('unsubscribe',  ['id'=>$id,'language'=>  app()->getLocale()]) }} }}" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;">
                            {{ __('Quitar') }}</a>
                        @if ($rated == false)
                        <a href="" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;" data-bs-toggle="modal" data-bs-target="#valorar_curso">
                            {{ __('Valorar') }}</a>
                        @endif
                        @if (isset($course->location))
                        <a href="{{ route('geolocalization',  ['id'=>$id,'language'=>  app()->getLocale() , 'coordinates'=>$course->location]) }}" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;"> {{ __('Cómo llegar') }}</a>
                        @endif
                        @else
                        <a href="{{ route('subscribe',  ['id'=>$id,'language'=>  app()->getLocale()]) }}" class="btn text-uppercase mx-2 py-2 items boton_sesion" style="font-weight: bold; text-shadow: #0B132B 1px 1px 1px; font-size: .9rem;"> {{ __('Añadir') }}</a>
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

        <table class="table mt-5">
            <thead class="thead-light">
                <tr>
                    <th class="w-25" scope="col">Usuario</th>
                    <th class="w-25" scope="col">Valoración</th>
                    <th scope="col">Comentario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratings as $rating)
                <tr>
                    <th class="w-25" scope="row">{{ $rating->user->name. " ". $rating->user->surnames}}</th>
                    <td class="w-25 rating" value="{{$rating->rating}}">{{$rating->rating}}</td>
                    <td>{{ $rating->comment }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- FIN SECCIÓN CURSO DETALLADO -->

<!-- Modal -->
<div class="modal fade" id="valorar_curso">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <section class="fondo_formulario_registro">
                <div class="container contenedor_modal contenedor_registro">
                    <form class="form-control formulario_valorar" id="registrarse" method="post" action="{{ route('rate', ['id'=>$id,'language'=>  app()->getLocale()] )}}">
                        {{ csrf_field() }}
                        <div class="row d-flex justify-content-start formulario_valorar">
                            <div class="col-12 p-3 d-flex justify-content-center align-items-center rounded bg-light">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <h2 class="section-heading m-0 text-center text-dark h3 text-uppercase">{{ $course->name }}</h2>
                                    </div>
                                    <div class="row col-lg-12 col-12 px-5">
                                        <div class="col-4 mb-3">
                                            Estrellas:
                                        </div>
                                        <div id="contenedor_est" class="col-8 mb-3">
                                            <i class="bi bi-star-fill estrella" value="1" style="color:yellow"></i>
                                            <i class="bi bi-star estrella" value="2" style="color:yellow"></i>
                                            <i class="bi bi-star estrella" value="3" style="color:yellow"></i>
                                            <i class="bi bi-star estrella" value="4" style="color:yellow"></i>
                                            <i class="bi bi-star estrella" value="5" style="color:yellow"></i>
                                            <input id="estr_valor" name="rating" type="hidden" value="1">
                                        </div>
                                        <div class="col-4 mb-3">
                                            Comentarios
                                        </div>
                                        <div class="col-8 mb-3">
                                            <textarea class="form-control p-2 campos_contacto" id="message" name="comment" placeholder="{{ __('Comentarios') }}" rows="5" style="resize:none"></textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">

                                        <button class="btn submit_registro boton_sesion py-2 items me-3 text-uppercase" type="submit">{{ __('Valorar') }}
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
@endsection

@section('script_link')
<script src="{{ asset('js/user.js') }}"></script>
<script src="{{ asset('js/course.js') }}"></script>
<script src="{{ asset('js/rate.js') }}"></script>
@endsection