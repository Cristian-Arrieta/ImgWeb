<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;

class Image extends Model 
{
    use SoftDeletes, CanBeLiked ,CanBeFavorited;
    
    protected $fillable = ['name','description','type','tags','width','height','date','path','user_id'];
    
    public function users()
    {
    	return $this->belongsTo (User::class , 'user_id');
    }

	/*
	public function tags()
   	{
   		return $this->belongsToMany('App\Tag')->withTimestamps();	
   	}
    */
	
    public function getPhotoRouteAttribute()
    {
		if($this->path)
		{
		
			return (asset($this->path.'.'.$this->type).'?'.time());
		}
		return (asset('img/users/default.bin'));		
    }	
	
    public function img_min()
    {
		if($this->path)
		{		
			if($this->type == 'gif')
			{
				return (asset($this->path.'.'.$this->type));
			}
			return (asset($this->path.'_min.'.$this->type).'?'.time());
		}
		return (asset('img/users/default.bin'));		
    }	
    
	
	public function comments()
	{
		return $this->hasMany('App\Comment')->orderby('id','desc');	
	}
	
	public function lik()
	{
		return $this->hasMany('Overtrue\LaravelFollow\FollowRelation','followable_id');	
	}
	
	public function scopeName($query ,$name)
    {
		if(starts_with($name,'#'))
		{
			$var = $query->where('tags','LIKE', "%$name")
							->orwhere('tags','LIKE', "$name #%")
							->orwhere('tags','LIKE', "%$name #%")
							->orwhere('tags','LIKE', "% $name %");
			
			return $var;			
		}
		else
			if($name)
				return $query->where('name','LIKE', "%$name%");
    }

	
}
