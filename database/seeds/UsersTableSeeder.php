<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
	        'name' => 'Ahmed Ayad',
	        'email' => 'info@pcasa.ae',
	        'password' => bcrypt('AyadAhmed123'),        	
        ]);
    }
}
