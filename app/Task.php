<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [
        '_token'
    ];
    public function tasks()
    {
        return $this->hasMany('App\TaskHistory', 'serviceId', 'id');
    }
}
