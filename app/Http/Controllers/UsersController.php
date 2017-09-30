<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show (User $user){
        return view('users.profile', compact('user'));
    }

    public function follow(User $user) 
    {
        if(request()->user()->canFollow($user)){
            request()->user()->following()->attach($user);
        }

        return back();
    }

    public function unfollow(User $user)
    {
        if (request()->user()->canUnfollow($user)) {
            request()->user()->following()->detach($user);
        }

        return back();
    }
}
