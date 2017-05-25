<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $guarded = [''];

    public function line()
    {
    	return $this->belongsTo(Line::class);
    }

    public function isComplete()
    {
    	# code...
    }
}
