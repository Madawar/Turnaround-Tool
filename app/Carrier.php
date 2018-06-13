<?php

namespace App;

use Helper;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $guarded = [
        '_token'
    ];

    public function services()
    {
        return $this->hasMany('App\Service', 'carrierId', 'id');
    }

    public function flights()
    {
        return $this->hasMany('App\Flight', 'carrier', 'id');
    }

    protected $appends = array('freighterTurnaroundTime', 'passengerTurnaroundTime', 'button');

    public function getFreighterTurnaroundTimeAttribute($value)
    {
        if (isset($this->attributes['freighterTurnaroundTime'])) {
            return Helper::formatTimeForUser($this->attributes['freighterTurnaroundTime']);
        }

    }

    public function getPassengerTurnaroundTimeAttribute($value)
    {
        if (isset($this->attributes['passengerTurnaroundTime'])) {
            return Helper::formatTimeForUser($this->attributes['passengerTurnaroundTime']);
        }
    }

    public function getButtonAttribute($value)
    {
        return 'Manage Services';
    }
}
