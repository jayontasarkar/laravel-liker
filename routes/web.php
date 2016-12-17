<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/posts', 'PostController@index');
Route::post('/posts', 'PostController@store');
Route::get('/user/posts', 'PostController@posts');
Route::post('/posts/{post}/likes', 'PostLikeController@store');