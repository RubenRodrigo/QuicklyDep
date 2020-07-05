<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'tipo', 'precio_final',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
