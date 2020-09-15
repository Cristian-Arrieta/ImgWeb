<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes ;
        
    protected $fillable = ['text'];
	
	public function users()
    {
    	return $this->belongsTo (User::class , 'user_id');
    }
	
	public function images()
    {
    	return $this->belongsTo (Image::class , 'image_id');
    }
}
