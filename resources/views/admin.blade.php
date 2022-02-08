@extends('template_user')

@section('title')
<title>{{ __('Panel') }} | G2Cursos</title>
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')

<nav class="nav_admin" style="margin-top: 7.5%;">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active text-dark" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
            {{ __('Mensajes') }}
            @if (count($messages) > 0)
                <span class="ms-1 badge rounded-pill bg-danger">
                    {{ count($messages) }}
                </span>
            @endif
        </button>
        <button class="nav-link text-dark" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
            {{ __('Peticiones') }}
            @if (count($cvs) > 0)
                <span class="ms-1 badge rounded-pill bg-danger">
                    {{ count($cvs) }}
                </span>
            @endif
        </button>
        <button class="nav-link text-dark" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('Usuarios') }}</button>
        <button class="nav-link text-dark" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('Cursos') }}</button>
        <button class="nav-link text-dark" id="nav-5-tab" data-bs-toggle="tab" data-bs-target="#nav-5" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('Estadísticas') }}</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table-responsive text-center">
                    <table class="table align-middle table-striped table-dark">
                        <tr>
                            <th class="p-1 px-3">{{ __('Nombre') }}</th>
                            <th class="p-1 px-3">{{ __('Email') }}</th>
                            <th class="p-1 px-3">{{ __('Teléfono') }}</th>
                            <th class="p-1 px-3">{{ __('Comentario') }}</th>
                            <th class="p-1 px-3">{{ __('Eliminar') }}</th>
                        </tr>
                        @if (count($messages) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay mensajes nuevos') }}</td></tr>
                        @endif
                        @foreach($messages as $message)
                            <form class="form-control formulario_sesion" method="post" action="{{ route('contact_delete', array(app()->getLocale(), $message->id)) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <tr>
                                    <td class="p-1 px-3"><p class="m-0">{{ $message->name }}</p></td>
                                    <td class="p-1 px-3"><p class="m-0">{{ $message->email }}</p></td>
                                    <td class="p-1 px-3"><p class="m-0">{{ $message->phone }}</p></td>
                                    <td class="p-1 px-3"><p class="m-0">{{ $message->comments }}</p></td>

                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="delete">
                                            <i class="btn bi bi-x-circle-fill" style="color: red; font-size: 30px" type="submit" name="btn"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table-responsive text-center">
                    <table class="table align-middle text-striped table-dark">
                        <tr>
                            <th class="p-1 pe-4 ps-4">{{ __('Nombre') }}</th>
                            <th class="p-1 pe-4">{{ __('Apellidos') }}</th>
                            <th class="p-1 pe-4">{{ __('Descarga') }}</th>
                            <th class="p-1 pe-4">{{ __('Nombre de empresa') }}</th>
                            <th class="p-1 pe-4">{{ __('Dirección') }}</th>
                            <th class="p-1 pe-4">{{ __('Localidad') }}</th>
                            <th class="p-1 pe-4">{{ __('Aceptar') }}</th>
                            <th class="p-1 pe-4">{{ __('Rechazar') }}</th>
                        </tr>

                        @if (count($cvs) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay peticiones nuevas') }}</td></tr>
                        @endif
                        @foreach($cvs as $cv)
                            <form class="form-control formulario_sesion" method="post" action="{{ route('upgrade', app()->getLocale()) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type='hidden' name='user' value="{{ $cv->id }}">
                                <tr>
                                    <td><p class="celdas_admin">{{ $cv->name }}</p></td>
                                    <td><p class="celdas_admin">{{ $cv->surnames }}</p></td>
                                    <td><a class="text-white celdas_admin" href="{{ route('show', $cv->cv) }}">{{ $cv->cv }}</a></td>
                                    @if(isset($cv->company->name))
                                    <td class="p-1 pe-4"><p class="celdas_admin">{{ $cv->company->name }}</p></td>
                                    <td class="p-1 pe-4"><p class="celdas_admin">{{ $cv->company->direction }}</p></td>
                                    <td class="p-1 pe-4"><p class="celdas_admin">{{ $cv->company->location }}</p></td>
                                    @else
                                    <td class="p-1 pe-4"><p class="celdas_admin">-</p></td>
                                    <td class="p-1 pe-4"><p class="celdas_admin">-</p></td>
                                    <td class="p-1 pe-4"><p class="celdas_admin">-</p></td>
                                    @endif

                                    <td class="p-1 pe-4">
                                        <button type="submit" class="btn" name="btn" value="accept">
                                            <i class="btn bi bi-check-circle-fill fa-lg" type="submit" style="color: green; font-size: 30px;" name="btn" value="accept"></i>
                                        </button>
                                    </td>
                                    <td class="p-1 pe-4">
                                        <button type="submit" class="btn" name="btn" value="decline">
                                            <i class="btn bi bi-x-circle-fill" style="color: red; font-size: 30px;" name="btn" value="decline"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table-responsive text-center">
                    <table class="table align-middle table-striped table-dark">
                        <tr>
                            <th class="p-1 px-3">{{ __('Nombre') }}</th>
                            <th class="p-1 px-3">{{ __('Apellidos') }}</th>
                            <th class="p-1 px-3">{{ __('DNI') }}</th>
                            <th class="p-1 px-3">{{ __('Email') }}</th>
                            <th class="p-1 px-3">{{ __('Modificar') }}</th>
                            <th class="p-1 px-3">{{ __('Banear') }}</th>
                        </tr>
                        @if (count($all_users) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay usuarios') }}</td></tr>
                        @endif
                        @foreach($all_users as $single_user)
                            <form class="form-control formulario_sesion" method="post" action="{{ route('profile_modify', array(app()->getLocale(), $single_user->id)) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type='hidden' name='panel' value="true">
                                <tr>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="name" type="text" value="{{ $single_user->name }}">
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="surnames" type="text" value="{{ $single_user->surnames }}">
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="dni" type="text" value="{{ $single_user->dni }}" disabled>
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="email" type="text" value="{{ $single_user->email }}">
                                    </td>

                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="modify_user">
                                            <i class="btn bi bi-slash-circle-fill" type="submit" style="color: green; font-size: 30px;" name="btn" value="accept"></i>
                                        </button>
                                    </td>
                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="ban_user">
                                            <i class="btn bi bi-dash-circle-fill" style="color: red; font-size: 30px;" name="btn"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>

                <div class="col-12 text-center m-2 mt-4 lead">{{ __('Usuarios baneados') }}</div>
                <div class="table-responsive text-center">
                    <table class="table align-middle table-striped table-dark">
                        <tr>
                            <th class="p-1 px-3">{{ __('Nombre') }}</th>
                            <th class="p-1 px-3">{{ __('Apellidos') }}</th>
                            <th class="p-1 px-3">{{ __('DNI') }}</th>
                            <th class="p-1 px-3">{{ __('Email') }}</th>
                            <th class="p-1 px-3">{{ __('Restaurar') }}</th>
                            <th class="p-1 px-3">{{ __('Eliminar') }}</th>
                        </tr>
                        @if (count($banned_users) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay usuarios baneados') }}</td></tr>
                        @endif
                        @foreach($banned_users as $banned_user)
                            <form class="form-control formulario_sesion" method="post" action="{{ route('profile_modify', array(app()->getLocale(), $banned_user->id)) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type='hidden' name='panel' value="true">
                                <tr>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="name" type="text" value="{{ $banned_user->name }}">
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="surnames" type="text" value="{{ $banned_user->surnames }}">
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="dni" type="text" value="{{ $banned_user->dni }}" disabled>
                                    </td>
                                    <td class="p-1 px-3">
                                        <input class="form-control" style="width: 13rem;" name="email" type="text" value="{{ $banned_user->email }}">
                                    </td>
                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="restore_user">
                                        <i class="btn bi bi-slash-circle-fill" type="submit" style="color: green; font-size: 30px;" name="btn" value="accept"></i>
                                        </button>
                                    </td>
                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="delete_user">
                                            <i class="btn bi bi-x-circle-fill" style="color: red; font-size: 30px" type="submit" name="btn"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table-responsive text-center">
                    <table class="table align-middle table-striped table-dark">
                        <tr>
                            <th class="p-1 px-3">{{ __('Título curso') }}</th>
                            <th class="p-1 px-3">{{ __('Precio curso') }}</th>
                            <th class="p-1 px-3">{{ __('Creador') }}</th>
                            <th class="p-1 px-3">{{ __('Email') }}</th>
                            <th class="p-1 px-3">{{ __('Eliminar') }}</th>
                        </tr>
                        @if (count($courses) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay cursos creados') }}</td></tr>
                        @endif
                        @foreach($courses as $course)
                            <form class="form-control formulario_sesion" method="post" action="{{ route('delete_course', array(app()->getLocale(), $course->id)) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <tr>
                                    <td class=""><p class="celdas_admin">{{ $course->name }}</p></td>
                                    <td class=""><p class="celdas_admin">{{ $course->price }}</p></td>
                                    <td class=""><p class="celdas_admin">{{ App\Models\User::find($course->teacher_id)->name . " " . App\Models\User::find($course->teacher_id)->surnames }}</p></td>
                                    <td class=" "><p class="celdas_admin">{{ App\Models\User::find($course->teacher_id)->email }}</p></td>

                                    <td class="p-1 px-3">
                                        <button type="submit" class="btn" name="admin_action" value="delete_user">
                                            <i class="btn bi bi-x-circle-fill" style="color: red; font-size: 30px" type="submit" name="btn"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="mt-3 d-flex justify-content-center align-items-center gap-5">
                    <p class="lead fw-bold">{{ __('Usuarios existentes') }}: {{ $num_users }}</p>
                    <p class="lead fw-bold">{{ __('Cursos creados') }}: {{ $num_courses }}</p>
                </div>

                <div class="mt-5 row d-flex justify-content-center text-center">
                    <p class="lead col-12">{{ __('Curso mejor valorado') }}</p>
                    <div class="row justify-content-center mx-4 mx-sm-0 mx-md-0 mx-lg-0">
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a id="curso_{{ $best_course->id }}"href="{{ route('course', ['id' => $best_course->id, 'language' => app()->getLocale()]) }}"
                                    class="link_curso" id="curso">
                                    <div class="imagen_card">
                                        <span class="badge badge-pill text-white bg-success items modalidad">
                                            @if (!is_null($best_course->location))
                                                {{ __('Presencial') }}
                                            @else
                                                Online
                                            @endif
                                        </span>
                                        <img class="img-fluid" src="/images/{{ $best_course->image }}"
                                            alt="{{ $best_course->name }}" />
                                    </div>
                                    <div class="portfolio-caption">
                                        <div class="d-flex justify-content-between align-items-baseline mb-3">
                                            <div class="portfolio-caption-heading lead items titulo_curso me-2">
                                                {{ $best_course->name }}</div>
                                            <div class="lead bold descripcion_cursos text-uppercase">
                                                @if ($best_course->price > 0)
                                                    {{ $best_course->price . '€' }}
                                                @else
                                                    {{ __('Gratis') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row m-0 p-0">
                                            <div class="col-6 p-0 docente_cursos text-start">
                                                <p class="m-0 items">
                                                    {{ $best_course->teacher->name . ' ' . $best_course->teacher->surnames }}</p>
                                            </div>
                                            <div class="col-6 p-0 valoracion d-flex justify-content-end align-items-center">
                                                <p class="m-0 me-1 pt-1 items">{{ $best_course->ratings()->average('rating') }}
                                                </p>
                                                <div class="rating"
                                                    value="{{ round($best_course->ratings()->average('rating')) }}"></div><br>
                                                <p class="m-0 pt-1 items">({{ $best_course->ratings()->count() }})</p>
                                            </div>
                                            <div class="col-12 m-0 p-0 mt-2 categorias">
                                                @foreach ($best_course->categories as $category)
                                                    <span class="badge badge-pill text-white items categorias_cursos"
                                                        id="{{ $best_course->name . '_' . $category->id }}">{{ $category->name }}</span>
                                                @endforeach
                                                <script>
                                                    var course = <?php echo $best_course; ?>;
                                                    var categorias = <?php echo $best_course->categories; ?>;
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
                    </div>
                </div>

                <div class="mt-5 mb-0 row d-flex justify-content-center text-center">
                    <p class="lead col-12 m-0">{{ __('Número de categorías en total') }}</p>
                    <canvas class="w-50 h-50" id="categorias"></canvas>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                <script>
                    var tag_names = <?php echo json_encode($tag_names); ?>;
                    var names = [];
                    for (let i = 0; i < tag_names.length; i++) {
                        names.push(tag_names[i]["name"]);
                    }

                    var tag_colors = <?php echo json_encode($tag_colors); ?>;
                    var colors = [];
                    for (let i = 0; i < tag_colors.length; i++) {
                        colors.push(tag_colors[i]["color"]);
                    }

                    var tag_number = <?php echo json_encode($tag_number); ?>;

                    new Chart("categorias", {
                        type: "doughnut",
                        data: {
                            labels: names,
                            datasets: [{
                                backgroundColor: colors,
                                data: tag_number,
                            }],
                        },
                        options: {
                            title: {
                                display: true,
                            },
                        },
                    });
                    Chart.defaults.global.defaultFontSize = 32;
                    </script>
            </div>
        </section>
    </div>
</div>
@endsection

@section('script_link')
<script src="{{ asset('js/user.js') }}"></script>
<script src="{{ asset('js/course.js')  }}"></script>
<script src="{{ asset('js/rate.js') }}"></script>
@endsection
