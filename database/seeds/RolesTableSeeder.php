<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
        	'name' => 'Admin',
        	'display_name' => 'Site admin',
        	'description' => 'Controls every thing.'
        ]);

        DB::table('roles')->insert([
        	'name' => 'Driver',
        	'display_name' => 'Bus driver',
        	'description' => 'The guy driving the bus.'
        ]);

        DB::table('roles')->insert([
        	'name' => 'Supervisor',
        	'display_name' => 'Bus supervisor',
        	'description' => 'The guy with the driver.'
        ]);

        DB::table('roles')->insert([
        	'name' => 'Parent',
        	'display_name' => 'parent',
        	'description' => 'parent and maybe student.'
        ]);
    }
}
