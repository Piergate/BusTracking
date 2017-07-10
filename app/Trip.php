<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = [];

    public function line()
    {
    	return $this->belongsTo(Line::class);
    }

    public function bus()
    {
    	return $this->belongsTo(Bus::class);
    }
}
