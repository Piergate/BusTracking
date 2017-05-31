<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    public function index()
    {
    	$driver = Role::find(2);
    	$drivers = $driver->users;
    	return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
    	return view('drivers.create');
    }
}
