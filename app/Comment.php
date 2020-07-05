<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable= [
        'contenido', 'id_comentario_respuesta'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
