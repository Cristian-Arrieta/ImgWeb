<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		/*Permission::create([
			'name' => 'Navegar usuarios',
			'slug' => 'users.index',
			'description' => 'Lista y navega todos los usuarios del sistema'
		]);
				
				Permission::create([
					'name' => 'Ver perfil de usuario',
					'slug' => 'users.show',
					'description' => 'Ver en datalle cada usuarios del sistema',
				]);
				
				Permission::create([
					'name' => 'Edicion de perfil de usuario',
					'slug' => 'users.perfil',
					'description' => 'Editar dato del perfil',
				]);
				
				*/
				
				Permission::create([
					'name' => 'Edicion de usuarios',
					'slug' => 'users.edit',
					'description' => 'Editar cualquier dato de un usuario del sistema',
				]);		
				
					
				
				Permission::create([
					'name' => 'Eliminar usuarios',
					'slug' => 'users.destroy',
					'description' => 'Eliminar cualquier dato de un usuario del sistema',
				]);		
		
		///////////////////////////////////////////////////////////////////////////////////////////
				
						
				Permission::create([
					'name' => 'Navegar roles',
					'slug' => 'roles.index',
					'description' => 'Lista y navega todos los roles del sistema',
				]);
				
				/*
				Permission::create([
					'name' => 'Ver detalle de roles',
					'slug' => 'roles.show',
					'description' => 'Ver en datalle cada roles del sistema',
				]);
				*/
				
				Permission::create([
					'name' => 'Crear roles',
					'slug' => 'roles.create',
					'description' => 'Crea cualquier dato de un rol del sistema',
				]);			
				
				Permission::create([
					'name' => 'Edicion de roles',
					'slug' => 'roles.edit',
					'description' => 'Editar cualquier dato de un rol del sistema',
				]);					
				
				Permission::create([
					'name' => 'Eliminar roles',
					'slug' => 'roles.destroy',
					'description' => 'Eliminar cualquier dato de un rol del sistema',
				]);
				
				/////////////////////////////////////////////////////////////////////////////////////			
		        
				
				Permission::create([
					'name' => 'Edicion de Imagenes',
					'slug' => 'images.edit',
					'description' => 'Editar cualquier Imagen de un usuario del sistema',
				]);	
				
				Permission::create([
					'name' => 'Eliminar Imagenes',
					'slug' => 'images.destroy',
					'description' => 'Eliminar cualquier imagen de un usuario del sistema',
				]);
				
				/////////////////////////////////////////////////////////////////////////////////////
				
				Permission::create([
					'name' => 'Edicion de Comentarios',
					'slug' => 'comments.edit',
					'description' => 'Editar cualquier Comentario de un usuario del sistema',
				]);	
				
				Permission::create([
					'name' => 'Eliminar Comentarios',
					'slug' => 'comments.destroy',
					'description' => 'Eliminar cualquier Comentario de un usuario del sistema',
				]);
				
				/////////////////////////////////////////////////////////////////////////////////////
				
				
				/////////////////////////////////////////////////////////////////////////////////////
    }
}
