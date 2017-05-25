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
}
