<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'tipo',
    ];

    public function user()
    {
        return $this->belongTo('App\User');
    }
    
    public function comments()
    {
        return $this->embedsMany('App\Comment');
    }

    public function establishments()
    {
        return $this->embedsMany('App\Establishment');
    }
    // public function descripcion()
    // {
    //     return $this->embedsMany('App\Descripcion');
    // }
}
