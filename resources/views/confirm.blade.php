<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>G2Cursos</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="seccion_recuperar pb-5">
        <span><i class="fa-5x bi bi-envelope-check"></i></span>
        <div class="section-heading m-0 text-center text-dark h6 mb-3 enviado_email">Se te ha enviado un correo, confírmalo</div>
        <div class="section-heading m-0 text-center text-dark h6 mb-3 enviado_email">An email has been sent to you, please confirm it</div>
        <div class="section-heading m-0 text-center text-dark h6 mb-3 enviado_email">Mezu bat bidali dizugu, baieztatu</div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "/es"
        }, 5000); // 5 second
     </script>

    <!-- LINKS SCRIPTS DE BOOTSTRAP -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/recovery.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</body>
</html>