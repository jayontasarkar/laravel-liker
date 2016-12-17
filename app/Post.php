<?php

namespace App;

use Auth;
use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'body'
    ];

    protected $appends = [
    	'likeCount', 'likedByCurrentUser', 'canBeLikedByCurrentUser'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getLikedByCurrentUserAttribute()
    {
    	if(!Auth::check()) return false;
    
    	return $this->likes->where('user_id', Auth::user()->id)->count() === 1;
    }

    public function getCanBeLikedByCurrentUserAttribute()
    {
    	if(!Auth::check()) return false;

    	return $this->user->id !== Auth::user()->id;
    }

    public function getLikeCountAttribute()
    {
    	return $this->likes->count();
    }

    public function likes()
    {
    	return $this->morphMany(Like::class, 'likeable');
    }
}
