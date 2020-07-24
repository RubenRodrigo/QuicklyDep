<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>¡Saludos!</h2>

<div>
    El usuario {{Auth::user()->name}} desea comunicarse contigo sobre tu <a href="{{action('PostController@show',$notification->data['idPost'])}}">publicación.</a>
</div>

</body>
</html>