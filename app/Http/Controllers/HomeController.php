<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Image;
use Overtrue\LaravelFollow\FollowRelation;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$img = array();
		
		if(Auth::check())
		{
			
			$foll = Auth::user()->followings(User::class)->get();//dd($foll);
			$popular = array();
			foreach ($foll as $f){
				$popular[] = FollowRelation::popular(Image::class)
				->orderBy('created_at','DESC')	
				->where('user_id','=',$f->id)->get(); 
			}
			$count = 0;//dd($popular);
			foreach ($popular as $ps)
			{
				
					foreach($ps as $p){
						if($count < 2)
							$img[] = Image::find($p->followable_id)->toArray();
						$count++;
					
				}
					$count = 0;
			}
			
		}
		$imm = Image::get()->toArray();
		
		$imm = array_reverse($imm);
		
		$ar = array_merge($img ,$imm);	
		
		$ar = array_unique($ar, SORT_REGULAR);
		
		//dd($img);
		$images = array();
		
		foreach ($ar as $i)
		{
			$images[] = Image::find($i['id']);
		}
		
		 // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($images);
 
        // Define how many items we want to be visible in each page
        $perPage = 9;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath(route('home')); 
		
        return view('home2',['images' => $paginatedItems]);
    }
	
	public function filtro(Request $request)
	{
		$name = $request->get('search');
		
		$users = User::orderBy('id','ASC')
			->name($name)
			->get();			
		
		$images = Image::orderBy('id','ASC')
			->name($name)
			->get();
			
		
			
		return view('filtro',compact('users','images'));	
	}
}
