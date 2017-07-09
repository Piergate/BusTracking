<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class LocationController extends Controller
{
    //
    public function locateMyBus()
    {
    	return view('location.bus');
    }
}
