<html>
<form class="form-control formulario_registro" method="post" action="{{ route('password-reset', app()->getLocale()) }}">
{{ csrf_field() }}
<input type="hidden" name="token" value="{{ $token }}">
<input type="email" name="email">
<input type="password" name="password">
<input type="password" name="password_confirmation">
    <input type="submit">
    </form>
</html>