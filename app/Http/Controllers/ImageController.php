<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Image;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Imagen; 
use File;
use Illuminate\Support\Facades\DB;

use Overtrue\LaravelFollow\FollowRelation;

use App\Notifications\NewMessage;
use Notification;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view ('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
	
		$data = request()->validate(['name' => 'required',
		'description' => '',
		'tags' => '',
		'img' => 'required|mimes:jpg,jpeg,gif,png',],
		['name.required' => 'The Name field is Required',
		'img.required' => 'The Image field is Required',
		]);
		
					
		//$data['img'] = file_get_contents($path.'img.jpg');
			
		$data['type'] = \File::extension($_FILES["img"]['name']);
		
		$today = new \DateTime('now');
			
		$data['date'] = $today->format('Y-m-d') ;
			
		$data['user_id'] = Auth::user()->id;
			
		//dd($data);
	
		$image = Image::create($data);
		

			
		$path = public_path().'\\Imagenes\\';
											
		
											
		if(!is_dir($path))
		{
			\File::makeDirectory($path);
		}
		
		$codigo = Auth::user()->id."00".$image->id.'00';
		
		$path = $path .($codigo).'\\';
		if(!is_dir($path)){
			\File::makeDirectory($path);
		}
			
		if($data['type'] != 'gif'){
		//2097152
			if($_FILES["img"]['size'] < 5242880)
			{
				Imagen::make($request->file('img'))					
					//->save(public_path().'\\'.'img.jpg');
					->save($path.$image->name.'.'.$image->type);

				$wh = getimagesize($request->file('img'));
			
				$data['width'] = $wh[0];
			
				$data['height'] = $wh[1];
			}		
				
			else
			{
				$wh = getimagesize($request->file('img'));
				
				$wi = $wh[0];
				
				$he = $wh[1];
				
				$TF = true;
				
				do
				{
					$wi = $wi/2;
					$he = $he/2;
					
					if($wi <= 700 || $he <= 700)
						$TF = false;
				}
				while($TF);
				
				Imagen::make($request->file('img'))	
					->resize($wi,$he)				
					->save($path.$image->name.'.'.$image->type);	
						
				$data['width'] = $wi;
			
				$data['height'] = $he;			
			}

			$wh = getimagesize($request->file('img'));
				
			$wi = $wh[0];
				
			$he = $wh[1];
				
			$TF = true;
				
			do
			{
				$wi = $wi/(1.5);
				$he = $he/(1.5);
				
				if( $he < 200)
					$TF = false;
			}
			while($TF);
			
			Imagen::make($request->file('img'))	
					->resize($wi,$he)				
					->save($path.$image->name.'_min.'.$image->type);	
				
		}
		else
		{			
			move_uploaded_file($_FILES['img']['tmp_name'] ,$path.$image->name.'.gif');
			
			$wh = getimagesize($path.$image->name.'.gif');
			
			$data['width'] = $wh[0];
			
			$data['height'] = $wh[1];
			
		}
		
		$data['path'] = 'Imagenes/'.$codigo.'/'.$image->name;
		
		$image->update($data);
		
		$users = Auth::user()->followers()->get();
  
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'mensaje' => 'subio nuevo contenido',
			'post' => $image->id,
			'name' => Auth::user()->name,
			'id' => Auth::user()->id,
        ];
		
        Notification::send($users, new NewMessage($details));
		
		return redirect()->route('images.show',compact('image'))->with('info','Image saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
				
		$tags = array();
		if($image->tags != null)
		{
			$tags = explode(' ',$image->tags);
		}
		$user = $image->users;
		$images = $user->images;
		
		$comments = Comment::where('image_id',$image->id)
			->orderBy('created_at','desc')
			->simplepaginate(3);
		
		
		/*# Find all articles liked by a user
		Article::whereLikedBy($user->id)
			->with('likesCounter') // Allow eager load (optional)
			->get();

		# Get Articles sorted by likes count asc
		$sortedArticles = Article::orderByLikesCount('asc')->get();

		# The default sort order is desc
		$sortedArticles = Article::orderByLikesCount()->get();*/
		
		//$asd = Image::orderByLikesCount()->take(3)->get();
			
		//$asd = Image::whereDislikedBy(Auth::user()->id)->get();	
			
	 //dd($asd);	
	
        return view ('images.show',compact('image','tags','user','images','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
		if ( Auth::user()->can('users.edit') || ( Auth::user()->id == $image->users->id))
		{
			$tags = array();
			if($image->tags != null)
			{
				$tags = explode(' ',$image->tags);
			}
			return view('images.edit',compact('image','tags'));
		}
		else
			return redirect()->route('images.show',compact('image'))->with('alert','You do not have Permission to Update this Post')	;		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Image $image)
    {
		if ( Auth::user()->can('users.edit') || ( Auth::user()->id == $image->users->id))
		{
			$data = request()->validate(['name' => 'required',
			'description' => '',
			'tags' => '',],
			[
			'name.required' => 'El campo Nombre es Obligatorio',
			]);
			
			
			
			$path = public_path().'\\Imagenes\\';	
			
			$codigo = $image->user_id."00".$image->id.'00';
				
			$path = $path .($codigo).'\\';
			
			$data['type'] = $image->type;
			
			
			if($image->name != $data['name'])
			{
				//dd($path.$data['name'].$image['type']);
				File::move($path.$image['name'].'.'.$image['type'],$path.$data['name'].'.'.$image['type']);
				
				if($image->type != 'gif')
				{
					/*
					Imagen::make($path.$image['name'].'.'.$image['type'])		
										->save($path.$data['name'].'.'.$image['type']);	
										
					unlink( public_path().'\\'.$image->path.'.'.$image->type);				
																
					Imagen::make($path.$image['name'].'.'.$image['type'])	
										->resize(150,200)				
										->save($path.$data['name'].'_min.'.$image['type']);	
										
					unlink( public_path().'\\'.$image->path.'_min.'.$image->type);	
						*/
						
					File::move(public_path().'\\'.$image->path.'_min.'.$image->type,$path.$data['name'].'_min.'.$image['type']);	
						
				}
				
				
				
				$data['path'] = 'Imagenes/'.$codigo.'/'.$data['name'];
			}
			
			
			$image->update($data);
			
			return redirect()->route('images.show',$image->id)->with('info','Image Updated Correctly');
		}
		else
			return redirect()->route('images.show',compact('image'))->with('alert','You do not have Permission to Update this Image')	;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {	
		
		
		$user = $image->users->id;
		
		
		DB::table('followables')
                ->where('followable_id', $image->id)
                ->update(['deleted_at' => new \DateTime(),'updated_at' => new \DateTime()]);
		
		DB::table('notifications')
				->where('data','LIKE','%,"post":'.$image->id.'}')
                ->delete();	
		
		$image->delete();
        return redirect()->route('users.show',compact('user'))->with('info','Successfully Deleted');
    }
    

    public function like(Request $request)
    {
		$image = Image::find($request->image_id);
		
		if (! $image->isLikedBy(Auth::user()))
			$response = Auth::user()->like($image);
		else
			$response = Auth::user()->unlike($image);

		return response()->json(['success'=>$response]);
		
    }

 
    public function favorite(Request $request)
    {
		$image = Image::find($request->image_id);
		
		if (! $image->isFavoritedBy(Auth::user()))
			$response = Auth::user()->favorite($image);
		else
			$response = Auth::user()->unfavorite($image);

		return response()->json(['success'=>$response]);
    }
   
    public function download(Image $image)
    {
    	/*$path = public_path().'/img/download';
		
	Imagen::make($image->img)
		->save('img/download/imagen.jpg');*/
	 $headers = array(
		              'Content-Type: '.$image->type,
		              		            );	
							  
    	return response()->download($image->path.'.'.$image->type, ($image->name).'.'.$image->type, $headers);
	
    }
    
	public function ranking()
    {
		$foll =FollowRelation::popular(Image::class)->where('relation','like')->take(10)->get() ;
		//$images = Image::orderByLikesCount()->take(10)->get();
		$images = [];
		foreach ($foll as $f)
		{
			$images[] = Image::find($f->followable_id);
		}
		
		return view('images.ranking',compact('images'));
	}
    
    public function favorites()
	{
		$images = Auth::user()->favorites('App\Image'::class)->get();
		//Auth::user()->favorites('App\Image'::class)->where(etc...)
		$images = $images->reverse();
		return view('images.favorites',compact('images'));	
	}
	
	public function favorites_filtro(Request $request)
	{
		$name = $request->get('name');
		
		$images = Auth::user()->favorites('App\Image'::class)
					->name($name)
					->get();
					
		$images = $images->reverse();
		return view('images.favorites',compact('images'));	
	}
	
    public function read()
	{
		$nots = Auth::user()->readNotifications;
		$rest = count($nots) - 3;
		while($rest > 0)
		{
			$rest--;
			Auth::user()->readNotifications->last()->delete();			
		}
		
		Auth::user()->unreadNotifications->markAsRead();
		
		return response()->json(['success'=> 'exito']);
	}
}
