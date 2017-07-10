<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
        	'name' => 'admin',
        	'email' => 'admin@bustracking.com',
        	'password' => bcrypt('admin'),
        	'phone' => '123'
        ]);

        $user->attachRole(Role::find(1));
    }
}
