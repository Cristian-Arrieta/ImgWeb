<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favorite(Request $request)
    {
		$image = Image::find($request->image_id);
		
		if (! $image->isFavoritedBy(Auth::user()))
			$response = Auth::user()->favorite($image);
		else
			$response = Auth::user()->unfavorite($image);

		return response()->json(['success'=>$response]);
    }
	
    public function store(Request $request)
    {
		//$data = request()->validate(['comment' => 'required' ]);
		
		$comment = new Comment();
		
		$comment->text = $request->comment;
		
		$comment->image_id = $request->image_id;
		
		$comment->user_id = Auth::user()->id;
					
		$response = $comment->save();
		
		return response()->json(['success'=>$response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Comment $comment)
    {
		
       $data = request()->validate(['text' => 'required' ]);
	   
	   $comment->update($data);
	   
	   return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
		
		return back()->with('info','Comentario eliminado Correctamente');
    }
}
