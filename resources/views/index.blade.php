@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="timeline">
        <div class="col-md-8 col-md-offset-2">
            <form action="#" @submit.prevent="postStatus">
                <div class="form-group">
                    <textarea id="body" class="form-control" rows="4" placeholder="What are ou upto?" maxlength="140" required v-model="body"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Post</button>
            </form>

            <div class="timeline">
                <h3>Timeline</h3>
                <p v-if="!posts.length">No posts to see here yet.</p>
                <div class="media" v-for="post in posts" v-if="posts.length" track-by="id">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" :src="post.user.avatar">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="user">
                            <strong><a :href="post.user.profileUrl" v-text="post.user.username"></a></strong> - <small v-text="post.postCreatedAt"></small>
                        </div>
                        <p v-text="post.body"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
