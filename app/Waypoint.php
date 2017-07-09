<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waypoint extends Model
{
    protected $guarded = [];

    public function line()
    {
    	return $this->belongsTo(Line::class);
    }
}
