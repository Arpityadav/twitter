<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'body']; 

    protected $appends = ['postCreatedAt'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getPostCreatedAtAttribute() {
        return $this->created_at->diffForHumans();
    }
}
