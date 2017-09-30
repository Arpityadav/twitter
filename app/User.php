<?php

namespace App;

use App\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $appends = [
        'avatar', 'profileUrl'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function getAvatar() {
        return 'http://www.gravatar.com/avatar/'. md5($this->email) . '?s=45&d=mm';
    }

    public function getAvatarAttribute() {
        return $this->getAvatar();
    }

    public function getProfileUrlAttribute() {
        return route('user.show', $this);
    }

    public function getRouteKeyName() {
        return 'username';
    }

    public function isNotCurrentUser(User $user) {
        return $this->id !== $user->id;
    }

    public function isFollowing(User $user) {
        return (bool) $this->following->where('id', $user->id)->count();
    }

    public function canFollow(User $user) {
        if(!$this->isNotCurrentUser($user)) {
            return false;
        }

        return !$this->isFollowing($user);
    }

    public function canUnfollow(User $user)
    {
        return $this->isFollowing($user);
    }

    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }
}
