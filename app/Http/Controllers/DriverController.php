<?php

namespace App\Http\Controllers;

use App\Bus;
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
        $buses = Bus::all();
    	return view('drivers.create', compact('buses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'bus' => 'nullable|numeric'
        ]);

        $bus = Bus::find($request->bus);

        Driver::create([
            'name' => $request->name,
            'bus' => $bus->id
        ]);

        return back();
    }
}
