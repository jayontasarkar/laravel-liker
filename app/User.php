<?php

namespace App;

use App\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getAvatarAttribute()
    {
        return "https://s.gravatar.com/avatar/" . md5($this->email) . "?s=50&d=mm";
    }
}
