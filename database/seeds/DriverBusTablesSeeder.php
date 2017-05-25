<?php

use Illuminate\Database\Seeder;

class DriverBusTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lines')->insert([
        	'fromRoute' => 'nasr city',
        	'toRoute' => 'october'
        ]);

        DB::table('buses')->insert([
        	'line_id' => 1,
        	'number' => 123,
        	'license' => 'sl3234d',
        	'capacity' => '50'
        ]);

        DB::table('users')->insert([
        	'bus_id' => '1',
        	'name' => 'driver',
        	'phone' => '011',
        	'email' => 'driver@bus.com',
        	'password' => bcrypt('password')
        ]);
        

        DB::table('role_user')->insert([
        	'user_id' => 1,
        	'role_id' => 2
        ]);

    }
}
