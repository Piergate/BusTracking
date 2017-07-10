<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $guarded = [''];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('studentsCount', function ($builder)
        {
            $builder->withCount('students');
        });

    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function students()
    {
        return $this->users->withRole('student');
    }

    public function supervisor()
    {
        return $this->users->withRole('supervisor');      
    }

    public function driver()
    {
        return $this->users->withRole('driver');   
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function isComplete()
    {
    	if ($this->complete) 
        {
            return true;
        }
        else
        {   
            return false;
        }
    }
}
