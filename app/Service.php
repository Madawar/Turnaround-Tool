<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task', 'serviceId', 'id');
    }
}
