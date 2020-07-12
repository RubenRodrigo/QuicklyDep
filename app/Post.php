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
        return $this->belongsTo('App\User');
    }
    
    public function comments()
    {
        return $this->embedsMany('App\Comment');
    }

    public function establishment()
    {
        return $this->hasOne('App\Establishment');
    }
    // public function descripcion()
    // {
    //     return $this->embedsMany('App\Descripcion');
    // }
}
