@if (app()->getLocale() == "es")
<option id="es" value="{{ route(Route::currentRouteName(), 'es') }}" selected>
    ES
</option>
<option id="en" value="{{ route(Route::currentRouteName(), 'en') }}">
    EN
</option>
<option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}">
    EU
</option>
@elseif (app()->getLocale() == "en")
<option id="es" value="{{ route(Route::currentRouteName(), 'es') }}">
    ES
</option>
<option id="en" value="{{ route(Route::currentRouteName(), 'en') }}" selected>
    EN
</option>
<option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}">
    EU
</option>
@else
<option id="es" value="{{ route(Route::currentRouteName(), 'es') }}">
    ES
</option>
<option id="en" value="{{ route(Route::currentRouteName(), 'en') }}">
    EN
</option>
<option id="eu" value="{{ route(Route::currentRouteName(), 'eu') }}" selected>
    EU
</option>
@endif