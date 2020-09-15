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
			['name.required' => 'The Name field is Required',
			'slug.required' => 'The Friendly URL field is Required',]);
		
		$perm = Array();
		
		if(!empty($request->get('permissions')))
		{
			foreach($request->get('permissions') as $r)
			{
				$perm[] = $r; 
				if ($r == (4 || 5 ||6))
				{
					$perm[] = 3;
				}
				
			}
			$perm = array_unique($perm);
		}
		
		$role = Role::create($data);	
		
		$role->permissions()->sync($perm);
		
		$slug = $role->slug;
		
		return redirect()->route('roles.show',compact('slug'))->with('info','Role saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$role = Role::where('slug','=',$slug)->firstOrFail();
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
		$role = Role::where('slug','=',$slug)->firstOrFail();
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
    public function update(Request $request, $slug)
    {
		$role = Role::where('slug','=',$slug)->firstOrFail();
		
        $data = request()->validate(['name'=>['required',Rule::unique('roles')->ignore($role->id)],
		'description'=> '',
		'slug' => ['required',Rule::unique('roles')->ignore($role->id)],
		'special' =>''],
		['name.required' => 'The Name field is Required',
		'slug.required' => 'The Friendly URL field is Required',]);
			
		$perm = Array();
		
		if(!empty($request->get('permissions')))
		{
			foreach($request->get('permissions') as $r)
			{
				$perm[] = $r; 
				if ($r == (4 || 5 ||6))
				{
					$perm[] = "3";
				}
				
			}
			$perm = array_unique($perm);
		}
		
		$role->update($data);	
		
		$role->permissions()->sync($perm);
		
		$slug = $role->slug;
		
		return redirect()->route('roles.show',compact('slug'))->with('info','Role Successfully Updated');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
		$role = Role::where('slug','=',$slug)->firstOrFail();
		
        $role->delete();
		
		return redirect()->route('roles.index')->with('info','Successfully Deleted');
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
