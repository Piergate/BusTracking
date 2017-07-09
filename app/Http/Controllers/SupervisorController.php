<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //
    public function index()
    {
    	return view('supervisors.index');
    }
}
