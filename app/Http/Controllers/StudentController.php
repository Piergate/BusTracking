<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
    	return view('students.index');
    }
}
