<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Feature extends Model
{
    protected $fillable= [
        'baños', 'dormitorios', 'garage', 'piscina', 'otros'
    ];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }
}
