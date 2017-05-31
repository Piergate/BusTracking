<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class LocationController extends Controller
{
    //
    public function locateMyBus()
    {
    	// $ip = geoip()->getClientIP();

    	// $location = geoip($ip);
    	// return [$location->lat, $location->lon];
    	// Mapper::map($location->lat, $location->lon);

    	return view('location.bus');
    }
}
