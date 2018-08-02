<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Helper;

class Task extends Model
{
    protected $guarded = [
        '_token'
    ];
    public function records()
    {
        return $this->hasMany('App\TaskHistory', 'serviceId', 'id');
    }

    public function getStartTimeAttribute($value)
    {
        return Helper::formatTimeForUser($value);
    }

    public function getEndTimeAttribute($value)
    {
        return Helper::formatTimeForUser($value);
    }



    protected $appends = array('timed');

    public function getTimedAttribute($value)
    {
        if (isset($this->attributes['timed'])) {
            if($this->attributes['timed'] == 1){
                return 'Yes';
            }else{
                return 'No';
            }
        }

    }
}
