<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    protected $guarded = [''];

    public function buses()
    {
    	return $this->hasMany(Bus::class);
    }

    public function waypoints()
    {
    	return $this->hasMany(Waypoint::class);
    }

    public function trips()
    {
        return $this->hasManyThrough(Trip::class, Bus::class);
    }
}
