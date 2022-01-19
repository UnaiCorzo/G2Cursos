@extends('template_user')

@section('title')
<title>{{ __('Panel') }} | G2Cursos</title>
@endsection
@section('lang')
@include('partials.langNav')
@endsection
@section('user_content')
<!-- SECCIÓN PETICIONES CREADOR -->
<section class="page-section seccion_cursos mt-5" id="curso">
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
</section>
@endsection
<!-- FIN SECCIÓN PETICIONES CREADOR -->

@section('script_link')
<script src="{{ asset('js/user.js') }}"></script>
<script src="{{ asset('js/course.js')  }}"></script>
@endsection