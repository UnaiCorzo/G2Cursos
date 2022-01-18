<html>
<form class="form-control formulario_registro" method="post" action="{{ route('password-request', app()->getLocale()) }}">
{{ csrf_field() }}
<input type="email" name="email">
    <input type="submit">
    </form>
</html>