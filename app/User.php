<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;

class User extends Authenticatable 
{
    use Notifiable,ShinobiTrait ,SoftDeletes, CanFollow, CanBeFollowed ,CanLike ,CanFavorite;
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	
	
	public function getPhotoRouteAttribute()
	{
		if($this->photo)
		{
			return 'data:image/jpg; base64 ,'.(base64_encode($this->photo));
		}
		return (asset('img/users/default.bin'));		
	}	
	
	
	 public function roles()
    	 {
       	 return $this->belongsToMany('Caffeinated\Shinobi\Models\Role')->withTimestamps();
 	   }		
	

	public function images()
	{
		return $this->hasMany('App\Image');	
	}
	
	
	public function comments()
	{
		return $this->hasMany('App\Comment');	
	}
	
	 public function scopeName($query ,$name)
    {
        if($name)
			return $query->where('name','LIKE', "%$name%");
    }	
	
	 public function scopeEmail($query ,$email)
    {
        if($email)
			return $query->where('email','LIKE', "%$email%");
    }
	
	/*
	public function scopeFiltro($query ,$name)
	{
		if($name)
			return $query->where('name','LIKE', "%$name%")
						->orwhere('email','LIKE', "%$name%");
	}
	*/
	
}
