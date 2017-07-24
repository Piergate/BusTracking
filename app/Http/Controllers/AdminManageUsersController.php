<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Auth;
use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $users = User::with('roles')->get();

       return view('admin.index', compact('users'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User;

        $user->name     = Input::get('name');
        $user->phone    = Input::get('phone');
        $user->email    = Input::get('email');
        $user->password = bcrypt(Input::get('phone'));
        switch (Input::get('role')) 
        {
            case 'student':
                $role = Role::find(4);
                break;
            case 'supervisor':
                $role = Role::find(3);
                break;
            case 'driver':
                $role = Role::find(2);
                break;
            case 'admin':
                $role = Role::find(1);
                break;
        }
        $user->save();

        $user->attachRole($role);
        

        return Redirect::to('/manageusers');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('admin.show', compact('user'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $user = User::find($id)->delete();
        return Redirect::to('/manageusers');
    }
}
