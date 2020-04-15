<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$user = User::create([
		'name' => 'Admin',
		'email' => 'asd@asd.asd',
		'password' => Hash::make('123456')
		
		]);
		
		
	$user->roles()->sync(1);        //
	
	User::create([
		'name' => 'Nelson',
		'email' => 'nel@nel.nel',
		'password' => Hash::make('123456')
		
		]);
	
	factory (User::class,20)->create();
	
    }
}
