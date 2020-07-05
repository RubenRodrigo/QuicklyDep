<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Establecimiento extends Model
{
    protected $fillable= [
        'precio', 'imagenes',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function Adresses()
    {
        return $this->embedsMany('App\Adress');
    }
}
