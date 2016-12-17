<?php

use App\Post;

Route::get('/posts', function (Post $post) {
    return $post->with('user')->latest()->get();
});
