<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [
        '_token',

    ];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'serviceId', 'id');
    }
}
