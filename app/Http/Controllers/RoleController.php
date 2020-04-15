<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$roles = Role::paginate();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
		return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(['name'=>['required',Rule::unique('roles')],
			'description' =>'',
			'slug' => ['required',Rule::unique('roles')],
			'special' => ''],
			['name.required' => 'El campo Nombre es Obligatorio',
			'slug.required' => 'El campo Url amigable es Obligatorio',]);
			
		$role = Role::create($data);	
		
		$role->permissions()->sync($request->get('permissions'));
		
		return redirect()->route('roles.show',compact('role'))->with('info','Rol guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
		$permissions  = Permission::get();
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = request()->validate(['name'=>['required',Rule::unique('roles')->ignore($role->id)],
		'description'=> '',
		'slug' => ['required',Rule::unique('roles')->ignore($role->id)],
		'special' =>''],
		['name.required' => 'El campo nombre es Obligatorio',
		'slug.required' => 'El campo Url amigable es Obligatorio',]);
			
		$role->update($data);	
		
		$role->permissions()->sync($request->get('permissions'));
		
		return redirect()->route('roles.show',compact('role'))->with('info','Rol actualizado con exito');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
		
		return redirect()->route('roles.index')->with('info','Rol eliminado con exito');
    }
	
	
	public function filtro (Request $request)
    {
				
		$name = $request->get('name');
		
		$roles = Role::orderBy('id','ASC')
			->name($name)
			->paginate();
		return view('roles.index',compact('roles'));

    }	
	
}
