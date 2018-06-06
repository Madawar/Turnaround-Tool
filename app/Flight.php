<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{

    protected $guarded = [
        '_token'
    ];


    public function cx()
    {
        return $this->hasOne('App\Carrier', 'id', 'carrier');
    }
}
