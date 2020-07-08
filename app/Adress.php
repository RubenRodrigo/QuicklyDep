<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Adress extends Model
{
    protected $fillable= [
        'pais', 'ciudad', 'distrito', 'direccion',
    ];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }

}
