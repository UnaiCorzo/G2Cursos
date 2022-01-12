@extends('template_user')

@section('title')
<title>Curso | G2Cursos</title>

@endsection
@section('user_content')
<!-- SECCIÓN CURSO DETALLADO -->
<section class="page-section seccion_cursos mt-5" id="curso">
    <div class="container mt-0">

        <div class="table table-white d-flex justify-content-center text-center">
            <table border="1">
                <tr>
                    <th class="p-1 pe-4 ps-4">Nombre</th>
                    <th class="p-1 pe-4">Apellidos</th>
                    <th class="p-1 pe-4">Descarga</th>
                    <th class="p-1 pe-4">Nombre de empresa</th>
                    <th class="p-1 pe-4">Dirección</th>
                    <th class="p-1 pe-4">Localidad de empresa</th>
                    <th class="p-1 pe-4">Aceptar</th>
                    <th class="p-1 pe-4">Rechazar</th>
                </tr>
                @foreach($users as $user)
                <form class="form-control formulario_sesion" method="post" action="{{ route('upgrade', app()->getLocale()) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type='hidden' name='user' value="{{$user->id}}">
                    <tr>
                        <td class="p-1 pe-4">{{$user->name}}</td>
                        <td class="p-1 pe-4">{{$user->surnames}}</td>
                        <td class="p-1 pe-4"><a class="text-dark" href="{{ route('show', array(app()->getLocale(), $user->cv)) }}">{{ $user->cv }}</a></td>
                        @if(isset($user->company->name))
                        <td class="p-1 pe-4">{{$user->company->name}}</td>
                        <td class="p-1 pe-4">{{$user->company->direction}}</td>
                        <td class="p-1 pe-4">{{$user->company->location}}</td>
                        @else
                        <td class="p-1 pe-4">-</td>
                        <td class="p-1 pe-4">-</td>
                        <td class="p-1 pe-4">-</td>
                        @endif

                        <td class="p-1 pe-4"><button type="submit" class="btn " name="btn" value="accept">
                                <i class="btn bi bi-check-circle-fill fa-lg " type="submit" style="color:green;font-size:30px" name="btn" value="accept"></i>
                            </button>
                        </td>
                        <td class="p-1 pe-4">
                            <button type="submit" class="btn " name="btn" value="decline">
                                <i class="btn bi bi-x-circle-fill" style="color:red;font-size:30px" name="btn" value="decline"></i>
                            </button>
                        </td>
                    </tr>

                </form>

                @endforeach
            </table>

        </div>

</section>
@endsection



<!-- FIN SECCIÓN CURSO DETALLADO -->

@section('script_link')
<script src="js/user.js"></script>
<script src="js/course.js"></script>
@endsection