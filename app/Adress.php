<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Adress extends Model
{
    protected $fillable= [
        'ciudad', 'distrito', 'direccion', 'id_post', 'precio', 'imagen'
    ];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }

}
