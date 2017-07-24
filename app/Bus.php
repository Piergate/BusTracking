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

        static::addGlobalScope('supervisorsCount', function ($builder)
        {
            $builder->withCount('supervisors');
        });

    }

    public function scopeComplete($query)
    {
        return $query->where('complete', true);
    }

    public function scopeNotComplete($query)
    {
        return $query->where('complete', false);
    }

    public function students()
    {
        return $this->hasMany(User::class)->withRole('student');
    }
    
    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function supervisors()
    {
        return $this->hasMany(User::class)->withRole('supervisor');      
    }

    public function driver()
    {
        return $this->hasMany(User::class)->withRole('driver');
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
