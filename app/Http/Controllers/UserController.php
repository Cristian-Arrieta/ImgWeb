<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\User;
use App\Image as Imagen;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::check())
		{
			if(count(Auth::user()->followings()->get()) != 0)
			{
				$ff = Auth::user()->followings()->get();
				
				$arr = array();
				
				foreach($ff as $f)
				{
					$xs = $f->followings()->get();
					foreach($xs as $x)
					{
						$arr[] = $x->id;
					}
				}
				$arr = array_unique($arr);
				
				$userss = User::orderBy('id','ASC')
							->whereIn('id',$arr)
							->get();
							
				$uss = User::get()->toArray();

				$ar = array_merge($userss->toArray(), $uss);

				$ar	= array_unique($ar, SORT_REGULAR);
				
				$clave = array_search(Auth::user()->toArray(), $ar);
				
				unset($ar[$clave]);
				
				$users = array();
				
				foreach($ar as $i)
				{
					$users[] = User::find($i['id']);
				}
				
				$currentPage = LengthAwarePaginator::resolveCurrentPage();
				
				$itemCollection = collect($users);
				
				$perPage = 15;
				
				$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
				$paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
				$paginatedItems->setPath(route('users.index'));

				return view('users.index',['users' => $paginatedItems ]);	
			}
			else
			{
				$users = User::simplePaginate();
				return view ('users.index',compact('users'));
			}
		}
	
    	$users = User::simplePaginate();
        return view ('users.index',compact('users'));
    }

	public function users()
	{
		
		$users = User::paginate(10);
		
		return view('users', compact('users'));

	}		
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user)
    {
    
    	$images = Imagen::where('user_id',$user->id)
			->orderBy('created_at','desc')
			->paginate(8);
        return view ('users.show',compact('user','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
		if ( Auth::user()->can('users.edit') || ( Auth::user()->id == $user->id))
		{
		
			$roles = Role::get();
			return view ('users.edit',compact('user','roles'));
			
		}
		else

			return redirect()->route('users.show',$user->id)->with('alert','You do not have the Permissions to Update this Profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
		if (Auth::user()->can('users.destroy') ||($user->id == Auth::user()->id)){
			
			$images = $user->images;
			
			
			foreach($images as $image)
			{
				DB::table('followables')
                ->where('followable_id', $image->id)
                ->update(['deleted_at' => new \DateTime(),'updated_at' => new \DateTime()]);
				
				$image->delete();
			}
			
			DB::table('followables')
                ->where('followable_id', $user->id)
				->orwhere('user_id',$user->id)
                ->update(['deleted_at' => new \DateTime(),'updated_at' => new \DateTime()]);
			

			DB::table('notifications')
				->where('data','LIKE','{"user_id":'.$user->id.',%')
                ->delete();	
			
			$comm = $user->comments;
			
			foreach($comm as $c){
				$c->delete();
			}
			
			$user->delete();
			return redirect()->route('users.index')->with('info','Successfully Deleted');}
		else
			return redirect()->route('users.show',compact('user'))->with('alert','You do not have the Permissions to Delete this Profile');	
    }
    
    public function perfil(User $user)//Sin Usar
    {
    	if( Auth::user()->id == $user->id)
    	   	    {
    	       		return view ('users.perfil',compact('user'));
    	   	    }
    	   	else
    	   	{
    	   		return redirect()->route('home')->with('alerta','No tiene permiso para actualizar este Usuario');
    	   	}    
    }
    
	
    public function update (User $user , Request $request)
    {
    
		if ( Auth::user()->can('users.edit') || ( Auth::user()->id == $user->id))
		{
			if( Auth::user()->id == $user->id)
			{				
				$data = $request->validate(['name'=>['required',Rule::unique('users')->ignore($user->id)],
				'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
				'password_org' =>'required',
				'password' =>'',
				'photo' => ''],
				['name.required' => 'The Name field is Required',
				'email.required' => 'The Email field is Required',
				'password_org.required' => 'The Current Password field is Required',]);
			}
			else
			{
				$data = $request->validate(['name'=>['required',Rule::unique('users')->ignore($user->id)],
				'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
				'password_org' =>'',
				'password' =>'',
				'photo' => ''],
				['name.required' => 'The Name field is Required',
				'email.required' => 'The Email field is Required',]);	
			}
			
			if (Hash::check($data['password_org'],$user->password) || Auth::user()->can('users.edit'))
			{
			
				if(!array_key_exists('photo',$data))
				{
					unset ($data['photo']);
				}
				else
				{
					//$this->validate($request, ['photo' => 'required|image']);
					$this->validate($request, ['photo' => 'required|mimes:jpg,jpeg']);
					
					$file = $_FILES['photo'];						
					
					$img = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
					
					$w = imagesx($img);
					$h = imagesy($img);
										
					$wh = getimagesize($request->file('photo'));
						
					$wi = $wh[0];
						
					$he = $wh[1];
						
					$TF = true;
						
					do
					{
						if($wi <= 500 || $he <= 500)
							$TF = false;
						else
						{
							$wi = $wi/2;
							$he = $he/2;	
						}					
						
					}
					while($TF);
					
					
					$truecolor = imagecreatetruecolor($wi,$he);
					
					imagecopyresampled($truecolor,$img ,0,0,0,0,$wi,$he,$w,$h);
					
					$dir = public_path().'\\'.'photo.jpg';
					
					imagejpeg($truecolor,$dir);
					
					
					
					$data['photo'] = file_get_contents('photo.jpg');
					
					//dd($data['photo'] );		
				}    
			
				if($data['password'] == null)
				{
					unset ($data['password']);
				}
				else
				{
					$data['password'] = Hash::make($request->all()['password']);
				}
				
				$user->update($data);
				
				if ( Auth::user()->can('roles.edit'))
				{					
					$user->roles()->sync($request->get('roles'));
					
				}			
						
				return redirect()->route('users.show',$user->id)->with('info','Profile Successfully Updated');
			}
			else
			{
				$roles = Role::get();
				return redirect()->route('users.edit',compact('user','roles'))->with('warning','The Current Password field is incorrect');
			}
		}
		else
			
			return redirect()->route('users.show',$user->id)->with('alert','You do not have the Permissions to Update this Profile');
    }
	
	

    
	public function index_followings()
	{
		$users = Auth::user()->followings()->get();		
		
		return view('users.followings',compact('users'));
	}
	
	
	public function index_followers()
	{
		$users = Auth::user()->followers()->get();		
		
		return view('users.followers',compact('users'));
	}
	
	
	public function ajaxRequest(Request $request)
	{

		$user = User::find($request->user_id);
		//sentecia que crea o elimina un follow
		$response = auth()->user()->toggleFollow($user);

		return response()->json(['success'=>$response]);

	}
	
	public function filtro (Request $request)
    {
		
		
		$name = $request->get('name');
		$email = $request->get('email');
		
		$users = User::orderBy('id','ASC')
			->name($name)
			->email($email)
			->paginate();
		return view('users.index',compact('users'));

    }	



	public function filtro_fol (Request $request)
    {
		
		$this_us = Auth::user()->id;
		$name = $request->get('name');
		$email = $request->get('email');
		
		$users = User::orderBy('id','ASC')
			->whereIn('id' ,
				DB::table('followables')
					->where('followable_id','=',$this_us)
					->where('relation','=','follow')
					->select('user_id'))
			->name($name)
			->email($email)			
			->paginate();	
			
		return view('users.followers',compact('users'));

    }		
	
	public function filtro_following (Request $request)
    {
		
		$this_us = Auth::user()->id;
		$name = $request->get('name');
		$email = $request->get('email');
		
		$users = User::orderBy('id','ASC')
			->whereIn('id' ,
				DB::table('followables')
					->where('user_id','=',$this_us)
					->where('relation','=','follow')
					->select('followable_id'))
			->name($name)
			->email($email)			
			->paginate();	
			
		return view('users.followings',compact('users'));

    }	
	
}
