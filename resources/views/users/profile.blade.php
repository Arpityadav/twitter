@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>{{ $user->username }}</h3>
                
                @if(auth()->user()->isNotCurrentUser($user))
                    @if(auth()->user()->isFollowing($user))
                        <a href="{{ route('user.unfollow', $user) }}">Unfollow</a>
                    @else
                        <a href="{{ route('user.follow', $user) }}">Follow</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection