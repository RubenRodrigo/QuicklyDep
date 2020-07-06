<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable= [
        'precio', 'imagen',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function adresses()
    {
        return $this->embedsMany('App\Adress');
    }
}
