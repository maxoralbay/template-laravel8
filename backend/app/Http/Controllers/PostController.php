<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /***
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }
    public function show($id){
        $post = Post::find($id);
        return view('post.show', ['post' => $post]);
    }
}
