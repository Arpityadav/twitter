<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Post $post)
    {
        $following_id = request()->user()->following()->pluck('users.id')->push(auth()->id());
        $allPosts = Post::whereIn('user_id', $following_id)->with('user');

        $posts = $allPosts->orderBy('created_at', 'desc')->take(request()->get('limit', 20))->get();

        return response()->json([
            'posts' => $posts,
            'posts_count' => $posts->count(),
        ]);
    }

    public function store() {
        $this->validate(request(), [
            'body' => 'required|max:140|min:2'
        ]);

        $createdPost = Post::create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);

        return response()->json(Post::with('user')->find($createdPost->id));
    }
}
