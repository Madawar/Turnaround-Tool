<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{



    public function cx()
    {
        return $this->hasOne('App\Carrier', 'id', 'carrier');
    }
}
