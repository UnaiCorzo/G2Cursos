<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ __('Recuperar contraseña') }} | G2Cursos</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="seccion_recuperar">
        <h2 class="section-heading m-0 text-center text-dark h3 text-uppercase mb-3">{{ __('Recuperar contraseña') }}</h2>
        <div class="subtitulo_recuperar">
            <p>{{ __('Paso 1') }}</p>
            <div class="info_crear_curso top">
                <i class="fas fa-info-circle"> </i>
                <p>{{ __('Introduce el email de tu cuenta y recibirás en el mismo un mensaje de recuperación') }}</p>
            </div>
        </div>
        <form class="d-flex flex-column justify-content-center align-items-center" method="post" action="{{ route('password-request', app()->getLocale()) }}" id="recuperar_1">
            {{ csrf_field() }}
            <div class="input_recuperar">
                <div class="campos_registro">
                    <input class="form-control p-2 campos_sesion campo_recuperar" type="email" placeholder="Email" name="email" />
                </div>
            </div>
            <button class="btn submit_sesion boton_sesion py-2 items text-uppercase" type="submit">
                {{ __('Enviar') }}
            </button>
        </form>
    </div>

    <!-- LINKS SCRIPTS DE BOOTSTRAP -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/recovery.js') }}"></script>
</body>
</html>