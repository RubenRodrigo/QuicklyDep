<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable= [
        'pais', 'ciudad', 'distrito', 'direccion', 'precio', 'imagen',
    ];

    public function posts()
    {
        return $this->belongsTo('App\Post');
    }

    // public function adresses()
    // {
    //     return $this->embedsMany('App\Adress');
    // }
}
