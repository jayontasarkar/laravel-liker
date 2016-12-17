<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostWasCreated;

class PostController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request, Post $post)
    {
    	$posts = $post->with('user')->latest()->get();

    	return view('timeline', compact('posts'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'body' => 'required|min:4'
    	]);

    	$post = $request->user()->posts()->create([
    		'body'  => $request->body
    	]);

        broadcast(new PostWasCreated($post))->toOthers();

    	return $post->load('user');
    }

    public function posts(Post $post)
    {
        return $post->with('user')->latest()->get();   
    }
}
