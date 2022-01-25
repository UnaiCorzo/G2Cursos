<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Error') }}</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container d-flex justify-content-center" style="height: 100vh;">
        <div class="align-self-center display-1">
            {{ __('Error') }}
        </div>
    </div>
</body>
</html>
