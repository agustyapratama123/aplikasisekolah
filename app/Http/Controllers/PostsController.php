<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class PostsController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('posts.index',compact(['posts']));
    }
}
