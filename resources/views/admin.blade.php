@extends('template_user')

@section('title')
<title>{{ __('Panel') }} | G2Cursos</title>
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')

<nav style="margin-top: 7%;">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active text-dark" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('Peticiones') }}</button>
        <button class="nav-link text-dark" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ __('Usuarios') }}</button>
        <button class="nav-link text-dark" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('Cursos') }}</button>
        <button class="nav-link text-dark" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('Estadísticas') }}</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table table-white d-flex justify-content-center text-center">
                    <table border="1">
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

                        @if (count($users) == 0)
                            <tr><td align="center" colspan="8">{{ __('No hay peticiones nuevas') }}</td></tr>
                        @endif
                        @foreach($users as $user)
                        <form class="form-control formulario_sesion" method="post" action="{{ route('upgrade', app()->getLocale()) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type='hidden' name='user' value="{{$user->id}}">
                            <tr>
                                <td class="p-1 pe-4">{{ $user->name }}</td>
                                <td class="p-1 pe-4">{{ $user->surnames }}</td>
                                <td class="p-1 pe-4"><a class="text-dark" href="{{ route('show', $user->cv) }}">{{ $user->cv }}</a></td>
                                @if(isset($user->company->name))
                                <td class="p-1 pe-4">{{ $user->company->name }}</td>
                                <td class="p-1 pe-4">{{ $user->company->direction }}</td>
                                <td class="p-1 pe-4">{{ $user->company->location }}</td>
                                @else
                                <td class="p-1 pe-4">-</td>
                                <td class="p-1 pe-4">-</td>
                                <td class="p-1 pe-4">-</td>
                                @endif

                                <td class="p-1 pe-4">
                                    <button type="submit" class="btn" name="btn" value="accept">
                                        <i class="btn bi bi-check-circle-fill fa-lg" type="submit" style="color:green;font-size:30px" name="btn" value="accept"></i>
                                    </button>
                                </td>
                                <td class="p-1 pe-4">
                                    <button type="submit" class="btn" name="btn" value="decline">
                                        <i class="btn bi bi-x-circle-fill" style="color:red;font-size:30px" name="btn" value="decline"></i>
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
                <div class="table table-white d-flex justify-content-center text-center">
                    <table border="1">
                        <tr>
                            <th class="p-1 px-3">{{ __('Nombre') }}</th>
                            <th class="p-1 px-3">{{ __('Apellidos') }}</th>
                            <th class="p-1 px-3">{{ __('DNI') }}</th>
                            <th class="p-1 px-3">{{ __('Email') }}</th>
                            <th class="p-1 px-3">{{ __('Modificar') }}</th>
                            <th class="p-1 px-3">{{ __('Banear') }}</th>
                            <th class="p-1 px-3">{{ __('Eliminar') }}</th>
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
    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
        <section class="page-section seccion_cursos">
            <div class="container mt-0">
                <div class="table table-white d-flex justify-content-center text-center">
                    <table border="1">
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
                                <td class="p-1 px-3">{{ $course->name }}</td>
                                <td class="p-1 px-3">{{ $course->price }}</td>
                                <td class="p-1 px-3">{{ App\Models\User::find($course->teacher_id)->name . " " . App\Models\User::find($course->teacher_id)->surnames }}</td>
                                <td class="p-1 px-3">{{ App\Models\User::find($course->teacher_id)->email }}</td>

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

    </div>
</div>
@endsection

@section('script_link')
<script src="{{ asset('js/user.js') }}"></script>
<script src="{{ asset('js/course.js')  }}"></script>
@endsection