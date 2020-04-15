<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	Role::create([
			'name' => 'Admin' ,
			'slug' => 'admin' ,
			'special' => 'all-access'
		]);
		
	$ad2 = Role::create([
			'name' => 'Admin2' ,
			'slug' => 'admin2' ,
			'special' => null
		]); 
	


	$ad2->permissions()->sync([1,2,7,8,9,10]);	
	
		
		
		
    }
}
