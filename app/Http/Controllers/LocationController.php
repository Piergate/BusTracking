<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class LocationController extends Controller
{
    //
    public function locateMyBus()
    {
    	
    	Mapper::map(53.381128999999990000, -1.470085000000040000);
    	// Mapper::map($longitude, $latitude);

    	return view('location.bus');
    }
}
