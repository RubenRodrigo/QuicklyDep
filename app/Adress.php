<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Adress extends Model
{
    protected $fillable= [
        'pais', 'provincia', 'distrito', 'direccion',
    ];

    public function establishment()
    {
        return $this->belongsTo('App\establishments');
    }

}
