<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8" />
</head>
<body>
<h1>Ingresar</h1>

@if(Session::has("msj"))
    <h2>{{ Session::get("msj") }}</h2>
@endif

{{ Form::open(['url' => 'login', 'method' => 'POST']) }}
Usuario: {{ Form::text('usuario') }}<br/>
Contraseña: {{ Form::password('clave') }}<br/>
{{ Form::submit('Entrar') }}
{{ Form::close() }}
</body>
</html>