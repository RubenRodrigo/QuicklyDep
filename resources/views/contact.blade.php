<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>¡Saludos!</h2>

<div>
    El usuario {{Auth::user()->name}} está interesado en tu <a href="{{action('PostController@show', $post_id )}}">publicación.</a>
</div>

</body>
</html>