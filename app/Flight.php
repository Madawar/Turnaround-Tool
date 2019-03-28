<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Helper;

class Flight extends Model
{

    protected $guarded = [
        '_token',

    ];

    public function services()
    {
        return $this->hasMany('App\Service', 'carrierId', 'carrier');
    }

    public function incidentals()
    {
        return $this->hasMany('App\IncidentalService', 'flightId', 'id');
    }

    public function cx()
    {
        return $this->hasOne('App\Carrier', 'id', 'carrier');
    }

    public function tasks()
    {
        return $this->hasMany('App\TaskHistory', 'flightId', 'id');
    }


    protected $appends = array('arrival', 'departure', 'STA', 'STD');

    public function getArrivalAttribute($value)
    {
        if (isset($this->attributes['arrival'])) {
            return Helper::formatDate($this->attributes['arrival']);
        }
    }

    public function getDepartureAttribute($value)
    {
        if (isset($this->attributes['departure'])) {
            return Helper::formatDate($this->attributes['departure']);
        }
    }

    public function getStdAttribute($value)
    {
        if (isset($this->attributes['STD'])) {
            return Helper::formatDate($this->attributes['STD']);
        }
    }

    public function getStaAttribute($value)
    {
        if (isset($this->attributes['STA'])) {
            return Helper::formatDate($this->attributes['STA']);
        }
    }
}
