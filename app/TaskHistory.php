<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    protected $guarded = [
        '_token'
    ];

    public function task()
    {
        return $this->hasOne('App\Task', 'id', 'taskId');
    }
    public function service()
    {
        return $this->hasOne('App\Service', 'id', 'serviceId');
    }
}
